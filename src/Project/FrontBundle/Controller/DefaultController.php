<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Reservation;
use Project\UserBundle\Entity\Search;

class DefaultController extends Controller
{
	public function indexAction() {

		$firstArray = UtilitiesAPI::getDefaultContent('inicio', $this);
		$secondArray = array();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find(3);
		$secondArray['idpage'] = $secondArray['page']->getId();
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
		$secondArray['tags'] = explode(',', $secondArray['page']->getTags());

		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:page.html.twig', $array);
	}
	public function tagAction($tag) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('tag', $this);
		$secondArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n.id,n.name,n.dateCreated,n.friendlyName,n.descriptionMeta FROM ProjectUserBundle:Page n WHERE n.tags like :tags ORDER BY n.dateCreated ASC";
		
		$query = $em -> createQuery($dql);
		$query -> setParameter('tags', '%'.$tag.'%');
		$secondArray['objects']  = $query -> getResult();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;    
        $secondArray['tag'] = $tag;
        $secondArray['search'] = false;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:tags.html.twig', $array);
	}

    public function reservationAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('reservation', $this);
		$secondArray = array();
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find($id);
		$locale = UtilitiesAPI::getLocale($this);
		///////////////////////////////////////////////////////////////////////////////////////////////////
		$data = new Reservation();
		$form = $this -> createFormBuilder($data) 
		-> add('name', 'text', array('required' => false))
		-> add('phone', 'text', array('required' => false)) 
		-> add('email', 'text', array('required' => false)) 
		-> add('rdate', 'text', array('required' => false)) 
		-> add('tickets', 'number', array('required' => false)) 
		-> getForm();

		$em = $this -> getDoctrine() -> getManager();
		$secondArray['message'] = '';

		if ($this -> getRequest() -> isMethod('POST')) {

			$form -> bind($this -> getRequest());
			$data -> setLang($locale);
			$data -> setDate(new \DateTime());
			$data -> setChecked(false);
			$data -> setPage($secondArray['page']);
			
			$em -> persist($data);
			$em -> flush();
			//echo'llego al post2';exit;

			$secondArray['aux'] = array('name'=>$data -> getName(),'phone'=>$data -> getPhone(),'email'=>$data -> getEmail(),'rdate'=>$data -> getRdate(),'tickets'=>$data -> getTickets());
			//ENVIAR CORREO ELECTRONICO
			$destinatario = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Setting') -> find(1);

			$destinatario = $destinatario->getValue();
			$sujeto = "NUEVA RESERVA";
			$mensaje = 'Saludos Administrador(a), se ha realizado una nueva RESERVA : '."\n\n".
					   'Usuario : ' . $data -> getName() . "\n".
					   'Telefono: ' . $data -> getPhone(). "\n". 
					   'Email: ' . $data -> getEmail(). "\n". 
					   'Evento/Taller: ' . $secondArray['page']->getName(). "\n". 
					   'Fecha: ' .$data -> getRdate(). "\n". 
					   '#Tickets: ' .$data -> getTickets(). "\n\n".
					   'Informacion generada por www.instalacionesefimeras.com'. "\n".
					   'REALEGO.ES';
			$headers = "De: ". $data -> getEmail() . "\n";
			mail ($destinatario, $sujeto, $mensaje);
		
			///////////////////////////
			$secondArray['message'] = 'Estimado(a) '.ucwords($data -> getName()).' su reserva ha sido guardada exitosamente...';
			if($locale==1){
				$secondArray['message'] = 'Dear '.ucwords($data -> getName()).' your booking has been saved successfully...';
			}
			
														}
		
		$secondArray['form'] = $form -> createView();
		$secondArray['url'] =  $this -> generateUrl('project_front_reservation', array('id' => $id));
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:reservation.html.twig', $array);
	}

	public function searchAction($term) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('search', $this);
		$secondArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n.id,n.name,n.dateCreated,n.friendlyName,n.descriptionMeta FROM ProjectUserBundle:Page n WHERE n.tags like :term or n.content like :term or n.name like :term or n.descriptionMeta like :term ORDER BY n.dateCreated ASC";
		
		$query = $em -> createQuery($dql);
		$query -> setParameter('term', '%'.$term.'%');
		$secondArray['objects']  = $query -> getResult();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;    
        $secondArray['tag'] = $term;
        $secondArray['search'] = true;

        $data = new Search();
        $data -> setName($term);
	    $data -> setDate(new \DateTime());
		$em -> persist($data);
		$em -> flush();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:tags.html.twig', $array);
	}
}
