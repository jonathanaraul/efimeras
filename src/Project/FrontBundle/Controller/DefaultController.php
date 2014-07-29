<?php

namespace Project\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Reservation;
use Project\UserBundle\Entity\Search;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="project_front_homepage")
	 */
	public function indexAction() {


		$firstArray = UtilitiesAPI::getDefaultContent('inicio', $this);
		$secondArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n FROM ProjectUserBundle:MenuItem n 
		        WHERE n.menu = :menu and
		              n.tipo != :tipo
		 ORDER BY n.rank ASC";
		$query = $em -> createQuery($dql);
		$query -> setParameter('menu', 1);
		$query -> setParameter('tipo', 2);
		$query ->setMaxResults(1);
		$secondArray['item']  = $query -> getOneOrNullResult();
		if($secondArray['item'] ==null){
         throw $this->createNotFoundException('No se ha configurado correctamente el sitio');
		}
		else{
        $secondArray['page']= null;

        $twig = '';

		if($secondArray['item']->getTipo()==0){
			$secondArray['page'] = $secondArray['item'] ->getPage();
			$twig = 'page';
		} 
		else{
			$secondArray['page'] = $secondArray['item'] ->getCategory();
			$twig = 'category';
		} 
		
		$secondArray['idpage'] = $secondArray['page']->getId();
		$secondArray['articles'] = null;
		$secondArray['listado'] = null;//UtilitiesAPI::esListado($secondArray['idpage'],$this);
		$secondArray['images'] = array();
		$secondArray['tags'] = explode(',', $secondArray['page']->getTags());
		if(trim($secondArray['tags'][0])=="")$secondArray['tags'] = null;
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:'.$twig.'.html.twig', $array);
	    }
	}
	/**
	 * @Route("/search/{term}", name="project_front_search", defaults={"term" = ""})
	 */
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

        if(trim($term)==''){
        	$data = new Search();
        	$data -> setName($term);
        	$data -> setDate(new \DateTime());
        	$em -> persist($data);
        	$em -> flush();       	
        }

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:tags.html.twig', $array);
	}
	/**
	 * @Route("/page/{id}/{friendlyname}", name="project_front_page")
	 */
	public function pageAction($id,$friendlyname) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('contacto', $this);
		$secondArray = array();
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find($id);
		$secondArray['idpage'] = $secondArray['page']->getId();
		$secondArray['articles'] = null;
		$secondArray['listado'] = null;//UtilitiesAPI::esListado($secondArray['idpage'],$this);
		$secondArray['images'] = array();
		$secondArray['tags'] = explode(',', $secondArray['page']->getTags());
		if(trim($secondArray['tags'][0])=="")$secondArray['tags'] = null;
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:page.html.twig', $array);
	}
	/**
	 * @Route("/category/{id}/{friendlyname}", name="project_front_category")
	 */
	public function categoryAction($id,$friendlyname) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('contacto', $this);
		$secondArray = array();
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Category') -> find($id);
		$secondArray['idpage'] = $secondArray['page']->getId();
		$secondArray['articles'] = null;
		$secondArray['listado'] = null;
		$secondArray['images'] = array();
		$secondArray['tags'] = explode(',', $secondArray['page']->getTags());
		if(trim($secondArray['tags'][0])=="")$secondArray['tags'] = null;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:category.html.twig', $array);
	}
	/**
	 * @Route("/tag/{tag}", name="project_front_tag")
	 */
	public function tagAction($tag) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('tag', $this);
		$secondArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n.id,n.name,n.created,n.friendlyName,n.descriptionMeta FROM ProjectUserBundle:Page n WHERE n.tags like :tags ORDER BY n.created ASC";
		
		$query = $em -> createQuery($dql);
		$query -> setParameter('tags', '%'.$tag.'%');
		$secondArray['objects']  = $query -> getResult();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find(1);
		$secondArray['idpage'] = null;    
        $secondArray['tag'] = $tag;
        $secondArray['search'] = false;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:tags.html.twig', $array);
	}
	/**
	 * @Route("/reservation/{id}", name="project_front_reservation")
	 */
    public function reservationAction($id, Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent('reservation', $this);
		$secondArray = array();
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find($id);
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		$data = new Reservation();
		$form = $this->createForm('reservation', $data);

		$em = $this -> getDoctrine() -> getManager();
		$secondArray['message'] = '';

		if ($this -> getRequest() -> isMethod('POST')) {

			$form -> bind($this -> getRequest());
			$data -> setDate(new \DateTime());
			$data -> setChecked(false);
			$data -> setLang(1);
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
			
			
														}
		
		$secondArray['form'] = $form -> createView();
		$secondArray['url'] =  $this -> generateUrl('project_front_reservation', array('id' => $id));
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:reservation2.html.twig', $array);
	}


}
