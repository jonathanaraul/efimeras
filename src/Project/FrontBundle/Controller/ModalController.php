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

class ModalController extends Controller
{
	
    public function messageAction() {
        return $this->render('ProjectFrontBundle:Default:mensajes.html.twig');
    }
	
    public function loginAction() {
        return $this->render('ProjectFrontBundle:Default:login.html.twig');
    }

	public function searchAction() {
		return $this->render('ProjectFrontBundle:Default:busqueda.html.twig');
	}

	public function newsletterAction() {
		return $this->render('ProjectFrontBundle:Default:newsletter.html.twig');
	}

	public function directionAction() {
		return $this->render('ProjectFrontBundle:Default:lugar.html.twig');
	}
	
}