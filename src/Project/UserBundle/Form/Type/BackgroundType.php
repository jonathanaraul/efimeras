<?php

// src/Project/UserBundle/Form/Type/BackgroundType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BackgroundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('name', 'text', array('required' => true))
        ->add('file', 'file', array('required' => false)) 
        ->add('home', 'checkbox', array('label' => 'En el inicio', 'required' => false, )) 
        ->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Background',
            ));
    }

    public function getName()
    {
        return 'background';
    }
}