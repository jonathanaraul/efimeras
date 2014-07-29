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


class PageController extends Controller {

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$url = $this -> generateUrl('project_back_page_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:Page o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$array = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);
		//$array['form'] =  $form -> createView();
		
		return $this -> render('ProjectBackBundle:Page:list.html.twig', $array);
	}


	public function createAction(Request $request) {
		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Nueva Pagina', $this);
		$secondArray = array('accion' => 'nuevo');
		$secondArray['url'] = $this -> generateUrl('project_back_page_create');
		$secondArray['data'] = new Page();

		$array = array_merge($firstArray, $secondArray);
		return PageController::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Editar Información', $this);
		$secondArray = array('accion' => 'edicion');
		$secondArray['url'] = $this -> generateUrl('project_back_page_edit', array('id' => $id));
		$secondArray['id'] = $id;

		$secondArray['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find($id);
		if (!$secondArray['data']) {
			throw $this -> createNotFoundException('La pagina que intenta e no existe ');
		}
		
		$array = array_merge($firstArray, $secondArray);
		return PageController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$locale = UtilitiesAPI::getLocale($class);
		$data = $array['data'];
		$em = $class->getDoctrine()->getManager();
        $userManager = $class->container->get('fos_user.user_manager');
        $user = $class->getUser();
		$filtros = array();

		$data->setPublished(true);

		$form = $class->createForm('page', $data);

        $form->handleRequest($request);

        if ($form->isValid()) {
        // perform some action, such as saving the task to the database
        	if ($array['accion'] == 'nuevo') {
        		$data -> setPublished(1);
        	    $data -> setRank(0);
				$data -> setSpecial(0);
				$data -> setSpacer(0);
				$data -> setRank(UtilitiesAPI::getRank($locale, $class));

        	}
        	$data -> setFriendlyName(UtilitiesAPI::getFriendlyName($data->getName(),$class));

        	$data->setUser($user);
            $data -> setIp($class -> container -> get('request') -> getClientIp());

        	$em->persist($data);
        	$em->flush();

        	return $class -> redirect($class -> generateUrl('project_back_page_list'));
        }

		$array['form'] = $form -> createView();

		return $class -> render('ProjectBackBundle:Page:new-edit.html.twig', $array);
	}

	public function deleteAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$em = $this -> getDoctrine() -> getManager();
		$object = $em -> getRepository('ProjectUserBundle:Page') -> find($id);
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
		$object = $em -> getRepository('ProjectUserBundle:Page') -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}
