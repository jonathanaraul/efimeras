<?php

namespace Project\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->getUser();
        if($user==null) return $this->redirect($this->generateUrl('fos_user_security_login'));
 
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery('SELECT COUNT(u.id) FROM ProjectUserBundle:User u');
        $usuariosRegistrados = $query->getSingleScalarResult();

        $query = $em->createQuery('SELECT COUNT(u.id) FROM ProjectUserBundle:Background u');
        $backgrounds = $query->getSingleScalarResult();

        $query = $em->createQuery('SELECT COUNT(u.id) FROM ProjectUserBundle:Page u');
        $pages = $query->getSingleScalarResult();

       return $this->render('ProjectBackBundle:Default:index.html.twig', array('usuariosRegistrados' => $usuariosRegistrados,'backgrounds' => $backgrounds,'pages'=>$pages));
    }
    public static function promover(){

    	$userManager = $this->container->get('fos_user.user_manager');
    	$user = $this->getUser();
    	$user-> addRole( 1);
        $userManager->updateUser($user);

    }
}
