<?php

// src/Project/UserBundle/Form/Type/ThemeType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       
        ->add('name', 'text', array('label' => 'Nombre','required' => true))
        ->add('color', 'text', array('label' => 'Color','required' => true))
        ->add('description', 'textarea', array('label' => 'Descripcion','required' => true))
        ->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Theme',
            ));
    }

    public function getName()
    {
        return 'theme';
    }
}