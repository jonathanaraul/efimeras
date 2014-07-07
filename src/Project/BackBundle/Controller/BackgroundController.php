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
use Project\UserBundle\Entity\Background;


class BackgroundController extends Controller {

	public function listAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();

		$config = UtilitiesAPI::getConfig('backgrounds',$this);
		$url = $this -> generateUrl('project_back_background_list');
		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Mostrar Información', $this);

		$locale = UtilitiesAPI::getLocale($this);
		$form = null;		
		$filtros = null;
	/*
		$objects = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findAll();
		$themes = $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsTheme') -> findAll();
		$filtros['theme'] = array();
		$filtros['parentPage'] = array();
		$filtros['published'] = array(1 => 'Si', 0 => 'No');

		$filtros['theme']= UtilitiesAPI::getFilter('CmsTheme',$this);
		$filtros['parentPage']= UtilitiesAPI::getFilter('Page',$this);


		$data = new Background();
		$form = $this -> createFormBuilder($data) 
		-> add('name', 'text', array('required' => false)) 
		-> add('special','choice', array('choices' => $filtros['published'], 'required' => false, ))
		-> add('theme', 'choice', array('choices' => $filtros['theme'], 'required' => false, )) 
		-> add('published', 'choice', array('choices' => $filtros['published'], 'required' => false, ))
		-> getForm();
		
		$em = $this -> getDoctrine() -> getEntityManager();
				
		if ($this -> getRequest() -> isMethod('POST')) {
			$form -> bind($this -> getRequest());

			if ($form -> isValid()) {

				$dql = "SELECT n FROM ProjectUserBundle:Background n ";
				$where = false;

				if (is_numeric($data -> getSpecial()))  {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					}
					$dql .= ' n.special = :special ';

				}
				if (is_numeric($data -> getTheme())) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= ' n.theme = :theme ';

				}
				if (!(trim($data -> getName()) == false)) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}

					$dql .= " n.name like :name ";

				}
				if (is_numeric($data -> getPublished())) {

					if ($where == false) {
						$dql .= 'WHERE ';
						$where = true;
					} else {
						$dql .= 'AND ';
					}
					$dql .= ' n.published = :published ';
				}
				
				if ($where == false) {
					$dql .= 'WHERE ';
					$where = true;
					} 
				else{
					$dql .= 'AND ';
					}
				$dql .= ' n.lang = :lang ';
		
				$query = $em -> createQuery($dql);

				if (is_numeric ($data -> getSpecial())) {
					$query -> setParameter('special', $data -> getSpecial());
				}
				if (is_numeric ($data -> getTheme()) ) {
					$query -> setParameter('theme', $data -> getTheme());
				}
				if (!(trim($data -> getName()) == false)) {
					$query -> setParameter('name', '%' . $data -> getName() . '%');
				}
				if (is_numeric ($data -> getPublished())) {
					$query -> setParameter('published', $data -> getPublished());
				}
				
				$query -> setParameter('lang', $locale);

			}
		}
		//////////////////////////////////////////////////////////////////////////////////////////////////
		else {*/
			$dql = "SELECT n FROM ProjectUserBundle:Background n ";
			$query = $em -> createQuery($dql);
		//}

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$objects = $pagination -> getItems();
		$auxiliar = array();

		for ($i = 0; $i < count($objects); $i++) {
			$auxiliar[$i]['id'] = $objects[$i] -> getId();
			$auxiliar[$i]['name'] = $objects[$i] -> getName();
			$auxiliar[$i]['published'] = $objects[$i] -> getPublished();
			$auxiliar[$i]['home'] = $objects[$i] -> getHome();
			$auxiliar[$i]['path'] = $objects[$i] -> getPath();
			$auxiliar[$i]['dateCreated'] = $objects[$i] -> getDateCreated();
			$auxiliar[$i]['dateUpdated'] = $objects[$i] -> getDateUpdated();
/*
			if($objects[$i] -> getBackground() != 0){
				$helper = $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsResource') -> find($objects[$i] -> getBackground());
				if($helper!= NULL){
					$auxiliar[$i]['background'] = $helper  -> getWebPath();
				}
			}

			$auxiliar[$i]['theme'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsTheme') -> find($objects[$i] -> getTheme()) -> getColor();
			//$auxiliar[$i]['media'] = ($objects[$i] -> getMedia() == 0) ? '0' : '' . $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsResource') -> find($objects[$i] -> getMedia()) -> getWebPath();
			$auxiliar[$i]['media'] = '0';
			if($objects[$i] -> getMedia() != 0){
				$helper = $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsResource') -> find($objects[$i] -> getMedia());
				if($helper!= NULL){
					$auxiliar[$i]['media'] = $helper  -> getWebPath();
				}
			}
*/
		}
		$objects = $auxiliar;
		$secondArray = array('pagination' => $pagination, 'filtros' => $filtros, 'objects' => $objects, 'url' => $url);
		//$secondArray['form'] =  $form -> createView();
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectBackBundle:Background:list.html.twig', $array);
	}


	public function createAction(Request $request) {
		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Nueva Pagina', $this);
		$secondArray = array('accion' => 'nuevo');
		$secondArray['url'] = $this -> generateUrl('project_back_background_create');
		$secondArray['data'] = new Background();

		$array = array_merge($firstArray, $secondArray);
		return BackgroundController::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Editar Información', $this);
		$secondArray = array('accion' => 'edicion');
		$secondArray['url'] = $this -> generateUrl('project_back_background_edit', array('id' => $id));
		$secondArray['id'] = $id;

		$secondArray['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> find($id);

		if (!$secondArray['data']) {
			throw $this -> createNotFoundException('La pagina que intenta e no existe ');
		}
		
		$array = array_merge($firstArray, $secondArray);
		return BackgroundController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
			
		$locale = UtilitiesAPI::getLocale($class);
		$data = $array['data'];
		$filtros = array();
        $userManager = $class->container->get('fos_user.user_manager');
        $user = $class->getUser();
        $em = $class->getDoctrine()->getManager();

		$form = $class->createForm('background', $data);

        $form->handleRequest($request);

        if ($form->isValid()) {
        // perform some action, such as saving the task to the database
        	if ($array['accion'] == 'nuevo') {
        		$data->setDateCreated(new \DateTime('now'));
        		$data->setPublished(1);
        	    $data->setRank(0);
        	}

        	$data->setDateUpdated(new \DateTime('now'));
        	$data->setUser($user);
            $data -> setIp($class -> container -> get('request') -> getClientIp());
        	if ($array['accion'] == 'nuevo')$em -> persist($data);

        	$em->flush();

        	return $class -> redirect($class -> generateUrl('project_back_background_list'));
        }

		$array['form'] = $form -> createView();
		

		return $class -> render('ProjectBackBundle:Background:new-edit.html.twig', $array);
	}

	public function deleteAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$em = $this -> getDoctrine() -> getManager();


		//Remover original
		$object = $em -> getRepository('ProjectUserBundle:Background') -> find($id);
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
		$object = $em -> getRepository('ProjectUserBundle:Background') -> find($id);
		$object -> setPublished($tarea);
		$em -> flush();


		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function homeAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		//INICIALIZAR VARIABLES

		$id = $post -> get("id");
		$tarea = intval($post -> get("tarea"));

		$em = $this -> getDoctrine() -> getManager();
		$object = $em -> getRepository('ProjectUserBundle:Background') -> find($id);
		$object -> setHome($tarea);
		$em -> flush();

		$estado = true;
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}