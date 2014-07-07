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
    /*
        $objects = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> findAll();
        $themes = $this -> getDoctrine() -> getRepository('ProjectUserBundle:CmsTheme') -> findAll();
        $filtros['theme'] = array();
        $filtros['parentPage'] = array();
        $filtros['published'] = array(1 => 'Si', 0 => 'No');

        $filtros['theme']= UtilitiesAPI::getFilter('CmsTheme',$this);
        $filtros['parentPage']= UtilitiesAPI::getFilter('Page',$this);


        $data = new Page();
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

                $dql = "SELECT n FROM ProjectUserBundle:Page n ";
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
            $dql = "SELECT n FROM ProjectUserBundle:User n ";
            //$dql .= 'WHERE n.lang = :lang ';
            $query = $em -> createQuery($dql);
            //$query -> setParameter('lang', $locale);
        //}

        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator -> paginate($query, $this -> getRequest() -> query -> get('page', 1), 10);

        $objects = $pagination -> getItems();
        $auxiliar = array();

        for ($i = 0; $i < count($objects); $i++) {
            $auxiliar[$i]['id'] = $objects[$i] -> getId();
            $auxiliar[$i]['username'] = $objects[$i] -> getUsername();
            $auxiliar[$i]['email'] = $objects[$i] -> getEmail();
            $auxiliar[$i]['enabled'] = $objects[$i] -> isEnabled();
            $auxiliar[$i]['lastLogin'] = $objects[$i] -> getLastLogin();
            $auxiliar[$i]['descripcion'] = $objects[$i] -> getDescripcion();
        }
        $objects = $auxiliar;
        $secondArray = array('pagination' => $pagination, 'filtros' => $filtros, 'objects' => $objects, 'url' => $url);
        //$secondArray['form'] =  $form -> createView();
        
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
