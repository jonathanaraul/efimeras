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
use Project\UserBundle\Entity\Setting;

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
    public function socialesAction()
    {
        $array['facebook'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(2);
        $array['twitter'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(3);
        $array['pinterest'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(5);
        $array['tuenti'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(4);

        return $this->render('ProjectFrontBundle:Helpers:sociales.html.twig', $array);
    }
    public function lugarAction($colorOb)
    {
        $array['lugar'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(6);
        $array['email'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(8);
        $array['telefono'] = $this-> getDoctrine()-> getRepository('ProjectUserBundle:Setting')-> find(7);
        $array['colorOb'] = $colorOb;
        return $this->render('ProjectFrontBundle:Helpers:lugar.html.twig', $array);
    }
    public function lasttimeAction($limite)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "select p from ProjectUserBundle:Page p order by p.id desc";
        $query = $em->createQuery($dql)->setMaxResults($limite);
        $resultado = $query->getResult();
        return $this->render('ProjectFrontBundle:Helpers:last-time.html.twig', array('elementp' => $resultado));
    }
}
