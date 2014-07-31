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


class ReservationController extends Controller {

	public function listAction(Request $request) {
		
		$em = $this-> getDoctrine()-> getManager();

		$url = $this-> generateUrl('project_back_reservation_list');
		$form = null;		
		$filtros = null;

		$dql = "SELECT o FROM ProjectUserBundle:Reservation o ";
		$query = $em-> createQuery($dql);

		$paginator = $this-> get('knp_paginator');
		$pagination = $paginator-> paginate($query, $this-> getRequest()-> query-> get('page', 1), 10);

		$array = array('pagination'=> $pagination, 'filtros'=> $filtros, 'url'=> $url);
		//$array['form'] =  $form -> createView();
		
		return $this-> render('ProjectBackBundle:Reservation:list.html.twig', $array);
	}
}