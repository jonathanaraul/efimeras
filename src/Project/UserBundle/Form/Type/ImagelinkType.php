<?php

// src/Project/UserBundle/Form/Type/ImageType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ImagelinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('name', 'text', array('label' => 'Nombre','required' => true))
        ->add('file', 'file', array('label' => 'Imagen','required' => false, 'attr' => array('accept' => 'image/*'))) 
        ->add('home', 'checkbox', array('label' => 'En el inicio', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        ->add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Imagen',
            ));
    }

    public function getName()
    {
        return 'imagelink';
    }
}