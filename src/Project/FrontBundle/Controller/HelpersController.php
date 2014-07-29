<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;



class HelpersController extends Controller
{
    public function menuAction($idpage,$idmenu,$mobile)
    {

      

		$em = $this->getDoctrine()->getManager();
		
		$query = $em -> createQuery('SELECT d
    								 FROM ProjectUserBundle:MenuItem d
   	 								 WHERE 
   	 								       d.published = :published  and d.menu = :menu
    								 ORDER BY d.rank ASC') 
			   -> setParameter('published', 1)
         -> setParameter('menu', $idmenu);

		$array['items'] = $query -> getResult();
		$array['idpage'] = $idpage;

        return $this->render('ProjectFrontBundle:Helpers:menu'.$mobile.'.html.twig', $array);
    }
}
