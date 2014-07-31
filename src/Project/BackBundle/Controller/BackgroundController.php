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

		$url = $this -> generateUrl('project_back_background_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:Background o ";
		$query = $em -> createQuery($dql);

		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

		$array = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);
		//$array['form'] =  $form -> createView();
		
		return $this -> render('ProjectBackBundle:Background:list.html.twig', $array);
	}

	public function createAction(Request $request) {

		$array = array('accion' => 'nuevo');
		$array['url'] = $this -> generateUrl('project_back_background_create');
		$array['data'] = new Background();

		return BackgroundController::procesar($array, $request, $this);
	}

	public function editAction($id, Request $request) {

		$array = array('accion' => 'edicion');
		$array['url'] = $this -> generateUrl('project_back_background_edit', array('id' => $id));
		$array['id'] = $id;

		$array['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> find($id);

		if (!$array['data']) {
			throw $this -> createNotFoundException('La pagina que intenta acceder no existe');
		}

		return BackgroundController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {

        $em = $class-> getDoctrine()-> getManager();
		$data = $array['data'];
        $user = $class-> getUser();

		$form = $class-> createForm('background', $data);

        $form->handleRequest($request);

        if ($form-> isValid()) {
		// Procesa accion en base de datos
        	$data-> setUser($user);
            $data-> setIp($class-> container-> get('request')-> getClientIp());
        	$em-> persist($data);
        	$em-> flush();

        	return $class-> redirect($class-> generateUrl('project_back_background_list'));
        }

		$array['form'] = $form-> createView();

		return $class -> render('ProjectBackBundle:Background:new-edit.html.twig', $array);
	}

}