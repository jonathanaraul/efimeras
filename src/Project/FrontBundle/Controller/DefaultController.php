<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction() {

		$firstArray = UtilitiesAPI::getDefaultContent('inicio', $this);
		$secondArray = array();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Resource') -> findByHome(1);
		$secondArray['idpage'] = null;
		$secondArray['theme'] = array('color'=>'black','id'=>0);
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:inicio.html.twig', $array);
	}
}
