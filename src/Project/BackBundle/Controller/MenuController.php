<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Util\StringUtils;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Page;
use Project\UserBundle\Entity\Category;
use Project\UserBundle\Entity\Menu;

class MenuController extends Controller {

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_menu_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:Menu o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$array = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);
		//$array['form'] =  $form -> createView();
		
		return $this -> render('ProjectBackBundle:Menu:list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this -> generateUrl('project_back_menu_create');
		$array['data'] = new Menu();

		return MenuController::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Editar Información', $this);
		$secondArray = array('accion' => 'edicion');
		$secondArray['url'] = $this -> generateUrl('project_back_menu_edit', array('id' => $id));
		$secondArray['id'] = $id;

		$secondArray['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Menu') -> find($id);
		if (!$secondArray['data']) {
			throw $this -> createNotFoundException('La pagina que intenta e no existe ');
		}
		
		$array = array_merge($firstArray, $secondArray);
		return MenuController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$locale = UtilitiesAPI::getLocale($class);
		$data = $array['data'];
		$em = $class->getDoctrine()->getManager();
        $user = $class->getUser();

		$filtros = array();

		$form = $class->createForm('menu', $data);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	$data -> setUser($user);
        	$em->persist($data);
        	$em->flush();

        	return $class -> redirect($class -> generateUrl('project_back_menu_list'));
        }

		$array['form'] = $form -> createView();

		return $class -> render('ProjectBackBundle:Menu:new-edit.html.twig', $array);
	}

	public function rankAction() {
		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Mostrar Información', $this);

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n FROM ProjectUserBundle:Menu n WHERE n.id != 3 ORDER BY n.rank ASC";
		
		$query = $em -> createQuery($dql);
		$objects = $query -> getResult();
		$secondArray = array('objects' => $objects);
		$array = array_merge($firstArray, $secondArray);

		return $this -> render('ProjectBackBundle:Menu:Rank.html.twig', $array);
	}

	public function rankPostAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES
		$order = $post -> get("order");
		$em = $this -> getDoctrine() -> getManager();
		for ($i = 0; $i < count($order); $i++) {

			$id = intval($order[$i]);
			$object = $em -> getRepository('ProjectUserBundle:Menu') -> find($id);
			$object -> setRank($i);
			$em -> flush();

		}

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function deleteAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$em = $this -> getDoctrine() -> getManager();
		$object = $em -> getRepository('ProjectUserBundle:Menu') -> find($id);
		$em -> remove($object);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function statusAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$tarea = intval($post -> get("tarea"));

		$em = $this -> getDoctrine() -> getManager();
		$object = $em -> getRepository('ProjectUserBundle:Menu') -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}
