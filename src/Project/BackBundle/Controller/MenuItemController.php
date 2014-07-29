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
use Project\UserBundle\Entity\MenuItem;

class MenuItemController extends Controller {

    public function itemModalAction() {
		
		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT o.id,o.name FROM ProjectUserBundle:Menu o ";
		$query = $em -> createQuery($dql);
		$objects = $query ->getResult();

		$array = array('objects' => $objects);
		
		return $this -> render('ProjectBackBundle:Helpers:modal-menu-item.html.twig', $array);
	}

	public function listAction($menu,Request $request) {

		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_menu_item_list', array('menu' => $menu));
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:MenuItem o WHERE o.menu = :menu";
		
		$query = $em -> createQuery($dql);
        $query->setParameter('menu', $menu);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$array = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);
		//$array['form'] =  $form -> createView();
		
		return $this -> render('ProjectBackBundle:MenuItem:list.html.twig', $array);
	}

	public function createAction($menu,Request $request) {

		$array = array('accion' => 'nuevo','menu'=>$menu);
		$array['url'] = $this -> generateUrl('project_back_menu_item_create', array('menu' => $menu));
		$array['data'] = new MenuItem();

		return MenuItemController::procesar($array, $request, $this);
	}

	public function editAction($menu,$id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Editar Información', $this);
		$secondArray = array('accion' => 'edicion','menu'=>$menu);
		$secondArray['url'] = $this -> generateUrl('project_back_menu_item_edit', array('menu' => $menu,'id' => $id));
		$secondArray['id'] = $id;

		$secondArray['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:MenuItem') -> find($id);
		if (!$secondArray['data']) {
			throw $this -> createNotFoundException('La pagina que intenta e no existe ');
		}
		
		$array = array_merge($firstArray, $secondArray);
		return MenuItemController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$locale = UtilitiesAPI::getLocale($class);
		$data = $array['data'];
		$em = $class->getDoctrine()->getManager();
        $user = $class->getUser();
        $menu = $class -> getDoctrine() -> getRepository('ProjectUserBundle:Menu')->find($array['menu']);
		$filtros = array();

		$form = $class->createForm('menuItem', $data);
		$data ->setMenu($menu);

        $form->handleRequest($request);

        if ($form->isValid()) {
        	$data -> setUser($user);
        	$data -> setRank(UtilitiesAPI::getRankItem($menu->getId(), $class));
        	$em->persist($data);
        	$em->flush();

        	return $class -> redirect($class -> generateUrl('project_back_menu_item_list', array('menu' => $menu->getId())));
        }

		$array['form'] = $form -> createView();

		return $class -> render('ProjectBackBundle:MenuItem:new-edit.html.twig', $array);
	}

	public function rankAction($menu) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Mostrar Información', $this);

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n FROM ProjectUserBundle:MenuItem n WHERE n.menu = :menu ORDER BY n.rank ASC";
		$query = $em -> createQuery($dql);
	    $query->setParameter('menu', $menu);
		$objects = $query -> getResult();

		$secondArray = array('objects' => $objects,'menu' =>$menu);
		$array = array_merge($firstArray, $secondArray);

		return $this -> render('ProjectBackBundle:MenuItem:Rank.html.twig', $array);
	}


	public function rankPostAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES
		$cantidad = intval($post -> get("cantidad"));

		$em = $this -> getDoctrine() -> getManager();
        $prueba = 0;
		for ($i = 0; $i < $cantidad; $i++) {
			
			$idElemento = intval($post -> get("elemento_".$i));
			$object =  $this -> getDoctrine() -> getRepository('ProjectUserBundle:MenuItem') -> find($idElemento);
			$object -> setRank($i);
			$em ->persist($object);
			$em -> flush();

        $prueba++;
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
		$object = $em -> getRepository('ProjectUserBundle:MenuItem') -> find($id);
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
		$object = $em -> getRepository('ProjectUserBundle:MenuItem') -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}
