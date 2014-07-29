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
use Project\UserBundle\Entity\Theme;

class ThemeController extends Controller {

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_theme_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:Theme o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$array = array('pagination' => $pagination, 'filtros' => $filtros,'url' => $url);
		//$array['form'] =  $form -> createView();
		
		return $this -> render('ProjectBackBundle:Theme:list.html.twig', $array);
	}

	public function createAction(Request $request) {
		$firstArray = UtilitiesAPI::getDefaultContent('Tema', 'Nueva Pagina', $this);
		$secondArray = array('accion' => 'nuevo');
		$secondArray['url'] = $this -> generateUrl('project_back_theme_create');
		$secondArray['data'] = new Theme();

		$array = array_merge($firstArray, $secondArray);
		return ThemeController::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Editar Información', $this);
		$secondArray = array('accion' => 'edicion');
		$secondArray['url'] = $this -> generateUrl('project_back_theme_edit', array('id' => $id));
		$secondArray['id'] = $id;

		$secondArray['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Theme') -> find($id);

		if (!$secondArray['data']) {
			throw $this -> createNotFoundException('La pagina que intenta e no existe ');
		}
		
		$array = array_merge($firstArray, $secondArray);
		return ThemeController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$locale = UtilitiesAPI::getLocale($class);
		$data = $array['data'];
		$filtros = array();
        $userManager = $class->container->get('fos_user.user_manager');
        $user = $class->getUser();
        $em = $class->getDoctrine()->getManager();

		$form = $class->createForm('theme', $data);

        $form->handleRequest($request);

        if ($form->isValid()) {
        // perform some action, such as saving the task to the database
            $em -> persist($data);
        	$em->flush();

        	return $class -> redirect($class -> generateUrl('project_back_theme_list'));
        }

		$array['form'] = $form -> createView();

		return $class -> render('ProjectBackBundle:Theme:new-edit.html.twig', $array);
	}

	public function deleteAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$em = $this -> getDoctrine() -> getManager();


		//Remover original
		$object = $em -> getRepository('ProjectUserBundle:Theme') -> find($id);
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
		$object = $em -> getRepository('ProjectUserBundle:Theme') -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();


		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}