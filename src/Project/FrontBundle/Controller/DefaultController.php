<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction() {

		$firstArray = UtilitiesAPI::getDefaultContent('inicio', $this);
		$secondArray = array();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;
		$secondArray['theme'] = array('color'=>'black','id'=>0);
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:inicio.html.twig', $array);
	}
	public function pageAction($id,$friendlyname) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('contacto', $this);
		$secondArray = array();
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find($id);
		$secondArray['idpage'] = $secondArray['page']->getId();
		$secondArray['articles'] = null;
		$secondArray['listado'] = null;//UtilitiesAPI::esListado($secondArray['idpage'],$this);
		$secondArray['images'] = array();
		//$secondArray['tags'] = explode(',', $secondArray['page']->getTags());

		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:page.html.twig', $array);
	}
}
