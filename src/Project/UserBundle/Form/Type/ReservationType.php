<?php

// src/Project/UserBundle/Form/Type/ReservationType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('name', 'text', array('required' => false))
        ->add('phone', 'text', array('required' => false)) 
        ->add('email', 'text', array('required' => false)) 
        ->add('rdate', 'text', array('required' => false)) 
        ->add('tickets', 'number', array('required' => false)) ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Reservation',
            ));
    }

    public function getName()
    {
        return 'reservation';
    }
}