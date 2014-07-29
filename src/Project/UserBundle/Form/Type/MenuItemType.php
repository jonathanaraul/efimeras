<?php

// src/Project/UserBundle/Form/Type/PageType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        -> add('name', 'text', array('required' => true, 'label' => 'Nombre'))
        -> add('description', 'textarea', array('required' => true, 'label' => 'Descripcion')) 
        -> add('tipo', 'choice', array(
            'choices'   => array(0 => 'Pagina', 1 => 'Categoria', 2 => 'Spacer'),
            'required'  => true,
            'label' => 'Tipo'
            ))
        -> add('category', 'entity', array(
            'class' => 'ProjectUserBundle:Category',
            'empty_value' => 'Opcional',
            'property' => 'name',
            'label' => 'Categoria',
            'required' => false, 
            ))
        -> add('page', 'entity', array(
            'class' => 'ProjectUserBundle:Page',
            'empty_value' => 'Opcional',
            'property' => 'name',
            'label' => 'Pagina',
            'required' => false, 
            ))
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 



        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\MenuItem',
            ));
    }

    public function getName()
    {
        return 'menuItem';
    }
}