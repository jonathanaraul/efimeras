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
use Symfony\Component\ExpressionLanguage\Expression;
use Symfony\Component\Security\Core\Util\StringUtils;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Page;
use Project\UserBundle\Entity\Category;
use Project\UserBundle\Entity\Menu;
use Project\UserBundle\Entity\Background;
class MenuController extends Controller {

	public function listAction(Request $request) {
		
		if ($this->get('security.context')->isGranted(new Expression('"ROLE_USER" in roles'))) {
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
		else if (!$this->get('security.context')->isGranted(new Expression('"ROLE_USER" in roles'))) {
        	throw new AccessDeniedException();
    	}
	}

	public function createAction(Request $request) {

		if ($this->get('security.context')->isGranted(new Expression('"ROLE_USER" in roles'))) {
			$array = array('accion' => 'nuevo');
			$array['url'] = $this -> generateUrl('project_back_menu_create');
			$array['data'] = new Menu();

			return MenuController::procesar($array, $request, $this);
		}
		else if (!$this->get('security.context')->isGranted(new Expression('"ROLE_USER" in roles'))) {
        	throw new AccessDeniedException();
    	}
	}

	public function editAction($id, Request $request) {

        $array = array('accion' => 'edicion');
		$array['url'] = $this -> generateUrl('project_back_menu_edit', array('id' => $id));
		$array['id'] = $id;

		$array['data'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Menu') -> find($id);
		if (!$array['data']) {
			throw $this -> createNotFoundException('La pagina que intenta acceder no existe');
		}

		return MenuController::procesar($array, $request, $this);
	}

	public static function procesar($array, Request $request, $class) {
		
		$em = $class-> getDoctrine()-> getManager();
		$data = $array['data'];
        $user = $class-> getUser();

		$form = $class-> createForm('menu', $data);

        $form->handleRequest($request);

        if ($form-> isValid()) {
        // Procesa accion en base de datos
        	$data-> setUser($user);
        	$em-> persist($data);
        	$em-> flush();

        	return $class-> redirect($class-> generateUrl('project_back_menu_list'));
        }

		$array['form'] = $form -> createView();

		return $class -> render('ProjectBackBundle:Menu:new-edit.html.twig', $array);
	}
}
