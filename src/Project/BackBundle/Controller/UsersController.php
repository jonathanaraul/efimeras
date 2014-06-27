<?php

namespace Project\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{
    public function loginAction()
    {
        return $this->render('ProjectBackBundle:Users:login.html.twig', array('name' => ''));
    }
    public function forgotAction()
    {
        return $this->render('ProjectBackBundle:Users:forgot.html.twig', array('name' => ''));
    }
    public function signupAction()
    {
        return $this->render('ProjectBackBundle:Users:signup.html.twig', array('name' => ''));
    }
    
}
