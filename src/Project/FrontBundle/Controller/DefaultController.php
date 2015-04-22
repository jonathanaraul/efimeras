<?php

namespace Project\FrontBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Project\UserBundle\Entity\Reservation;
use Project\UserBundle\Entity\Mensaje;
use Project\UserBundle\Entity\Email;
use Project\UserBundle\Entity\Search;

class DefaultController extends Controller
{

	/**
	 * @Route("/botones/newsletter", name="project_front_botones_newsletter")
	 */
    public function botonesNewsletterAction() {

        $em = $this-> getDoctrine()-> getManager();
        $peticion = $this-> getRequest();
        $doctrine = $this-> getDoctrine();
        $post = $peticion-> request;
        
        $email = trim($post -> get("email"));
        $elemento = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Email') -> findByEmail($email);
        if(!$elemento){
        	$object = new Email();
        	$object-> setEmail($email);
        	$em -> persist($object);
        	$em-> flush();
        	$respuesta = 'Te has suscrito exitosamente';        	
        }
        else{
            $respuesta = 'Tu email ya se encontraba registrado en nuestro newsletter';
        }

        $respuesta = new response(json_encode(array('respuesta'=> $respuesta)));
        $respuesta-> headers-> set('content_type', 'aplication/json');
        return $respuesta;
    }
	/**
	 * @Route("/botones/mensaje", name="project_front_botones_mensaje")
	 */
    public function botonesMensajeAction() {

        $em = $this-> getDoctrine()-> getManager();
        $peticion = $this-> getRequest();
        $doctrine = $this-> getDoctrine();
        $post = $peticion-> request;

        // Obtener variables del post en el ajax
        $asunto = trim($post -> get("asunto"));
        $email = trim($post -> get("email"));
        $mensaje = trim($post -> get("mensaje"));
        //$tarea = intval($post-> get("tarea"));

        // Procesa accion en base de datos
        $object = new Mensaje();
        $object-> setAsunto($asunto);
        $object-> setDestinatario('master@efimeras.com');
        $object-> setRedactor($email);
        $object-> setContenido($mensaje);
        $em -> persist($object);
        $em-> flush();

        $estado = true;
        $respuesta = new response(json_encode(array('estado'=> $estado)));
        $respuesta-> headers-> set('content_type', 'aplication/json');
        return $respuesta;
    }

	/**
	 * @Route("/", name="project_front_homepage")
	 */
	public function indexAction() {

		$firstArray = UtilitiesAPI::getDefaultContent('inicio', $this);
		$secondArray = array();
		$thirdArray = array();
		$fourArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n, p FROM ProjectUserBundle:MenuItem n 
				JOIN n.page p
		        WHERE n.menu = :menu and
		              n.tipo != :tipo and 
		              p.principal = :principal
		 ORDER BY n.rank ASC";
		$query = $em -> createQuery($dql);
		$query -> setParameter('menu', 1);
		$query -> setParameter('tipo', 2);
		$query -> setParameter('principal', 1);
		$query ->setMaxResults(1);
		$secondArray['item']  = $query -> getOneOrNullResult();
		if ($secondArray['item'] !=null){
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
		//$secondArray['idmenu'] = $secondArray['page']->getMenu();
		$secondArray['articles'] = null;
		$secondArray['listado'] = null;//UtilitiesAPI::esListado($secondArray['idpage'],$this);
		$secondArray['images'] = array();
		$secondArray['tags'] = explode(',', $secondArray['page']->getTags());
		if(trim($secondArray['tags'][0])=="")$secondArray['tags'] = null;
		
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:'.$twig.'.html.twig', $array);
	    }

	    else if($secondArray['item'] ==null){
			$dqlpage = "SELECT p FROM ProjectUserBundle:Page p 
			        WHERE p.principal = 1";
			$querypage = $em -> createQuery($dqlpage);
			$querypage ->setMaxResults(1);
			$thirdArray['page']  = $querypage -> getOneOrNullResult();

			if($thirdArray['page'] !=null)
			{
				//$thirdArray['page']= null;
				//$thirdArray['page'] = $thirdArray['pagedos'] ->getId();
				$thirdArray['idpage'] = $thirdArray['page'] ->getId();
				$thirdArray['Background'] = $thirdArray['page'] ->getBackground();
				$thirdArray['articles'] = null;
				$thirdArray['listado'] = null;//UtilitiesAPI::esListado($thirdArray['idpage'],$this);
				$thirdArray['images'] = array();
				$thirdArray['tags'] = explode(',', $thirdArray['page']->getTags());
				if(trim($thirdArray['tags'][0])=="")$thirdArray['tags'] = null;

				$array = array_merge($firstArray, $thirdArray);
				return $this -> render('ProjectFrontBundle:Default:page.html.twig', $array);
			}
			else 
			{
				$dqllast = "SELECT n FROM ProjectUserBundle:MenuItem n 
		        WHERE n.menu = :menu and
		              n.tipo != :tipo  
				 ORDER BY n.rank ASC";
				$querylast = $em -> createQuery($dqllast);
				$querylast -> setParameter('menu', 1);
				$querylast -> setParameter('tipo', 2);
				$querylast ->setMaxResults(1);
				$fourArray['item']  = $querylast -> getOneOrNullResult();
				if ($fourArray['item'] !=null){
			        $fourArray['page']= null;

			        $twig = '';

					if($fourArray['item']->getTipo()==0){
						$fourArray['page'] = $fourArray['item'] ->getPage();
						$twig = 'page';
					} 
					else{
						$fourArray['page'] = $fourArray['item'] ->getCategory();
						$twig = 'category';
					} 
				
					$fourArray['idpage'] = $fourArray['page']->getId();
					//$fourArray['idmenu'] = $fourArray['page']->getMenu();
					$fourArray['articles'] = null;
					$fourArray['listado'] = null;//UtilitiesAPI::esListado($fourArray['idpage'],$this);
					$fourArray['images'] = array();
					$fourArray['tags'] = explode(',', $fourArray['page']->getTags());
					if(trim($fourArray['tags'][0])=="")$fourArray['tags'] = null;
					
					$array = array_merge($firstArray, $fourArray);
					return $this -> render('ProjectFrontBundle:Default:'.$twig.'.html.twig', $array);
				    }
				    else 
				    {
			    		throw $this->createNotFoundException('No se ha configurado correctamente el sitio principal');
				    }
				}
		}
	}
	/**
	 * @Route("/search/{term}", name="project_front_search", defaults={"term" = ""})
	 */
	public function searchAction($term) {
		
		$firstArray = UtilitiesAPI::getDefaultContent('search', $this);
		$secondArray = array();

		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n.id,n.name,n.created,n.friendlyName,n.descriptionMeta FROM ProjectUserBundle:Page n WHERE n.tags like :term or n.content like :term or n.name like :term or n.descriptionMeta like :term ORDER BY n.created DESC";
		
		$query = $em -> createQuery($dql);
		$query -> setParameter('term', '%'.$term.'%');
		$secondArray['objects']  = $query -> getResult();
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;    
		$secondArray['page'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Page') -> find(1);   
        $secondArray['tag'] = $term;
        $secondArray['search'] = true;

        if(trim($term)!=''){
        	$data = new Search();
        	$data -> setName($term);
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
		$dql = "SELECT n FROM ProjectUserBundle:Page n WHERE n.tags like :tags ORDER BY n.created DESC";
		
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

			$secondArray['aux'] = array(
				'firstName'=>$data -> getFirstName(),
				'lastNname'=>$data -> getLastName(),
				'phone'=>$data -> getPhone(),
				'email'=>$data -> getEmail(),
				'nationality'=>$data -> getNationality(),
				'education'=>$data -> getEducation()
				);

			//ENVIAR CORREO ELECTRONICO
			$destinatario = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Setting') -> find(1);

			$destinatario = $destinatario->getValue();
			$sujeto = "NUEVA RESERVA";
			$mensaje = 'Saludos Administrador(a), se ha realizado una nueva RESERVA : '."\n\n".
					   'Nombre : ' . $data -> getFirstName() . "\n".
					   'Apellido : ' . $data -> getLastName() . "\n".
					   'Telefono: ' . $data -> getPhone(). "\n". 
					   'Email: ' . $data -> getEmail(). "\n". 
					   'Nacionalidad: ' . $data -> getNationality(). "\n". 
					   'Formacion: ' . $data -> getEducation(). "\n". 
					   'Evento/Taller: ' . $secondArray['page']->getName(). "\n". 
					   'Informacion generada por www.master-arquitectura-efimera.com'. "\n".
					   'Equipo Efimeras';
			$headers = "De: ". $data -> getEmail() . "\n";
			mail ($destinatario, $sujeto, $mensaje);
		
			///////////////////////////

			$secondArray['message'] = 'Estimado(a) '.ucwords($data -> getFirstName()).' '.ucwords($data -> getLastName()).', su solicitud de informacion a quedado registrada.';
			
			
			}
		
		$secondArray['form'] = $form -> createView();
		$secondArray['url'] =  $this -> generateUrl('project_front_reservation', array('id' => $id));
		$secondArray['backgrounds'] = $this -> getDoctrine() -> getRepository('ProjectUserBundle:Background') -> findByHome(1);
		$secondArray['idpage'] = null;

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:reservation2.html.twig', $array);
	}

	public function noticiasAction($id, $template, $color) {
		
		$em = $this -> getDoctrine() -> getManager();
		$dql = "SELECT n FROM ProjectUserBundle:Page n WHERE n.category = :category ORDER BY n.created DESC";
		
		$query = $em -> createQuery($dql);
		$query -> setParameter('category', $id);

		$variables = $query->getResult();

		return $this -> render('ProjectFrontBundle:Default:noticia.html.twig', 
			array('variables' => $variables, 'template' => $template, 'color' => $color));
	}

	public function imagenNoticiaAction($contenido) {
		

		$codigoHTML=$contenido;

		$salida = false;
		$codigofinal="";

		while ($salida == false)
		{

			$eimageni= explode('<img alt="', $codigoHTML);
			if(isset($eimageni[1]))
			{
				$inicioImagen='<img alt="';
				$separarImagen=explode('px;" />',$eimageni[1]);
				$finImagen=$separarImagen[0].'px;" />';
				$codigoImagen=$inicioImagen.$finImagen;
				$codigoHTML=str_replace($codigoImagen,"", $codigoHTML);
				
			}
			else
			{
				$salida = true;
			}

		}

		return new Response(substr(''.$codigoHTML.'...', 0, 250));
	}
}
