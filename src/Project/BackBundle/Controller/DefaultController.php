<?php

namespace Project\BackBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Usuario;
use Project\UserBundle\Entity\Page;
use Project\UserBundle\Entity\Category;
use Project\UserBundle\Entity\Menu;
use Project\UserBundle\Entity\Background;
use Project\UserBundle\Entity\Theme;
use Project\UserBundle\Entity\MenuItem;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //Tu haces tus cambios trabajas todos tus codigos guardas y luego vas al sourcetree	
        //otro cambio mas
        // Para traer cambios solo debes darle en pull

        $user = $this->getUser();
        if($user==null) return $this->redirect($this->generateUrl('fos_user_security_login'));
 
        $em = $this->getDoctrine()->getManager();
        /*
        $object = $em -> getRepository('ProjectUserBundle:User') -> find(1);
        $object-> addRole( 1 );
        $em-> persist($object);
        $em-> flush();  */     

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

        $url = $this -> generateUrl('project_back_homepage');

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
    public function deleteAction() {

        $em = $this -> getDoctrine() -> getManager();
        

        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;

        // Obtener variables del post en el ajax
        $id = $post -> get("objeto");
        $tipo = $post -> get("tipo");
        // Procesa accion en base de datos
        $estado = false;
        $codigo = '';
        $em->getConnection()->beginTransaction();
        try {
            $object = $em -> getRepository('ProjectUserBundle:'.$tipo) -> find($id);
            $em -> remove($object);
            $em -> flush();
            $em->getConnection()->commit();
            $estado = true;
            
        } 
        catch (\Exception $e) {
            $codigo= $e->getCode();
            //$em->getConnection()->rollback();
            //throw $e;
        }
        
        $respuesta = new response(json_encode(array('estado'=> $estado,'codigo'=> $codigo)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }

    public function statusAction() {

        $em = $this-> getDoctrine()-> getManager();
        $peticion = $this-> getRequest();
        $doctrine = $this-> getDoctrine();
        $post = $peticion-> request;

        // Obtener variables del post en el ajax
        $id = $post -> get("objeto");
        $tipo = $post -> get("tipo");
        $tarea = intval($post-> get("tarea"));

        // Procesa accion en base de datos
        $object = $em-> getRepository('ProjectUserBundle:'.$tipo)-> find($id);
        $object-> setPublished($tarea);
        $em-> flush();

        $estado = true;
        $respuesta = new response(json_encode(array('estado'=> $estado)));
        $respuesta-> headers-> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function setHomeAction() {

        $em = $this-> getDoctrine()-> getManager();
        $peticion = $this-> getRequest();
        $doctrine = $this-> getDoctrine();
        $post = $peticion-> request;

        // Obtener variables del post en el ajax
        $id = $post -> get("objeto");
        $tipo = $post -> get("tipo");
        $tarea = intval($post-> get("tarea"));

        // Procesa accion en base de datos
        $object = $em-> getRepository('ProjectUserBundle:'.$tipo)-> find($id);
        $object-> setHome($tarea);
        $em-> flush();

        $estado = true;
        $respuesta = new response(json_encode(array('estado'=> $estado)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
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
