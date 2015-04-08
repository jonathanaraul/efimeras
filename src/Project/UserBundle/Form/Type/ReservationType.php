<?php

// src/Project/UserBundle/Form/Type/ReservationType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\RangeValidator;
use Symfony\Component\Validator\Constraints\MinValidator;
use Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('firstName', 'text', array('required' => true))
        ->add('lastName', 'text', array('required' => true))
        ->add('email', 'email', array('required' => true))
        ->add('phone', 'text', array('required' => true))
        ->add('nationality', 'choice', array(
            'choices'   => array(
                'esp' => 'Español', 
                'ext' => 'Extranjero',
                'arg' => 'Argentino',
                'bol' => 'Boliviano',
                'chi' => 'Chileno',
                'col' => 'Colombiano',
                'cos' => 'Costarricense',
                'cub' => 'Cubano',
                'ecu' => 'Ecuatoriano',
                'sal' => 'Salvadoreño',
                'gua' => 'Guatemalteco',
                'hon' => 'Hondureño',
                'mex' => 'Mexicano',
                'nic' => 'Nicaragüense',
                'pan' => 'Panameño',
                'par' => 'Paraguayo',
                'per' => 'Peruano',
                'pue' => 'Puertorriqueño',
                'dom' => 'Dominicano',
                'uru' => 'Uruguayo',
                'ven' => 'Venezolano'
                ),
            'required' => true))
        ->add('education', 'text', array('required' => true));
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