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

        ->add('firstName', 'text', array('required' => false))
        ->add('lastName', 'text', array('required' => false))
        ->add('email', 'text', array('required' => false))
        ->add('phone', 'text', array('required' => false))
        ->add('nationality', 'choice', array(
            'choices'   => array(
                'esp' => 'Española', 
                'ext' => 'Extranjero'
                ),
            'required' => false))
        ->add('education', 'text', array('required' => false));
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