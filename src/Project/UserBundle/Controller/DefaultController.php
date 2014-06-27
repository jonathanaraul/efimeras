<?php

namespace Project\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Project\UserBundle\Entity\Invitation;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectUserBundle:Default:index.html.twig', array('name' => $name));
    }
    public function adminAction()
    {

    	$user = $this->getUser();
    	$usuarios = array();
    	//$usuarios[0] = array('email'=>'jonathan.araul@gmail.com','nombre'=>'Jonathan Araul','sexo'=>1 );
    	$usuarios[0] = array('email'=>'arauljonathan@hispanosoluciones.com','nombre'=>'Jonathan Araul','sexo'=>1 );


    	for ($i=0; $i < count($usuarios); $i++) { 
        	# code...
    		$object = new Invitation();

    		$object->setEmail($usuarios[$i]['email']  );
    		$object->send();
    		$object->setUser($user);


    		$em = $this->getDoctrine()->getManager();
    		$em->persist($object);
    		$em->flush();

            $usuarios[$i]['code']=$object->getCode();

    		$message = \Swift_Message::newInstance()
    		->setSubject('Invitacion a SistemasDinamicos.edu.ve')
    		->setFrom('noreply@sistemasdinamicos.com')
    		->setTo($usuarios[$i]['email'] )
    		->setBody(
    			$this->renderView(
    				'ProjectUserBundle:Mails:invitation.html.twig',
    				$usuarios[$i]
    				), 'text/html'
    			)
    		;
    		$this->get('mailer')->send($message);
    	}






    	echo'sera que mando los dos emails?';exit;

        echo 'habra persistido con el codigo '. $object->getCode();exit;
        return $this->render('ProjectUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
