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
    public function menuMobileAction()
    {
    	$locale = UtilitiesAPI::getLocale($this);
	
		$em = $this->getDoctrine()->getManager();
		
		$query = $em -> createQuery('SELECT d
    								 FROM ProjectUserBundle:Page d
   	 								 WHERE d.lang      = :locale and
   	 								       d.published = :published and
                                           d.special = 0
    								 ORDER BY d.rank ASC') 
    		   -> setParameter('locale', $locale)
			   -> setParameter('published', 1);

		$array['objects'] = $query -> getResult();
	
        return $this->render('ProjectFrontBundle:Helpers:menu-mobile.html.twig', $array);
    }
    public function menuAction($idpage,$theme)
    {
    	$locale = UtilitiesAPI::getLocale($this);
	
		$em = $this->getDoctrine()->getManager();
		
		$query = $em -> createQuery('SELECT d
    								 FROM ProjectUserBundle:Page d
   	 								 WHERE d.lang      = :locale and
   	 								       d.published = :published  and
                                           d.special = 0
    								 ORDER BY d.rank ASC') 
    		   -> setParameter('locale', $locale)
			   -> setParameter('published', 1);

		$array['objects'] = $query -> getResult();
		$array['idpage'] = $idpage;
		$array['theme'] = $theme;
	
        return $this->render('ProjectFrontBundle:Helpers:menu.html.twig', $array);
    }
}
