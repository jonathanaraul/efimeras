<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        if($user==null) return $this->redirect($this->generateUrl('fos_user_security_login'));
 
        $em = $this->getDoctrine()->getManager();

        $firstArray = array();
        
        $firstArray['usuariosRegistrados'] = $em->getRepository('ProjectUserBundle:User')
               ->getAllLength();

        $firstArray['backgrounds'] = $em->getRepository('ProjectUserBundle:Background')
               ->getAllLength();

        $firstArray['pages'] = $em->getRepository('ProjectUserBundle:Page')
               ->getAllLength();

        $firstArray['terminosBuscados'] = $em->getRepository('ProjectUserBundle:Search')
               ->getAllLength();

        $firstArray['terminos'] = $em->getRepository('ProjectUserBundle:Search')
               ->getDistinctRankingAll();

        for ($i=0; $i < count($firstArray['terminos']); $i++) { 
            $firstArray['terminos'][$i]['color'] = DefaultController::randColor($this);
        }


        //config = UtilitiesAPI::getConfig('pages',$this);
        $url = $this -> generateUrl('project_back_homepage');
        //$firstArray = UtilitiesAPI::getDefaultContent('PAGINAS', 'Mostrar Información', $this);

        $locale = UtilitiesAPI::getLocale($this);
        $form = null;       
        $filtros = null;

        $dql = "SELECT o FROM ProjectUserBundle:User o ";
        $query = $em -> createQuery($dql);

        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

        $secondArray = array('pagination' => $pagination, 'filtros' => $filtros, 'url' => $url);
        
        $array = array_merge($firstArray, $secondArray);
  

       return $this->render('ProjectBackBundle:Default:index.html.twig', $array);
    }
    public static function promover(){

    	$userManager = $this->container->get('fos_user.user_manager');
    	$user = $this->getUser();
    	$user-> addRole( 1);
        $userManager->updateUser($user);

    }
    public static function randColor($this) {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                                        }
}
