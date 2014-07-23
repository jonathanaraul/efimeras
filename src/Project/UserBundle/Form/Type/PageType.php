<?php

// src/Project/UserBundle/Form/Type/PageType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        -> add('name', 'text', array('required' => true))
        -> add('descriptionMeta', 'textarea', array('required' => true)) 
        -> add('keywords', 'text', array('required' => true)) 
        -> add('tags', 'text', array('required' => true))
        -> add('content', 'ckeditor', array(
            'config' => array(
                'toolbar' => array(
                    array(
                        'name'  => 'document',
                        'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                        ),
                    '/',
                    array(
                        'name'  => 'basicstyles',
                        'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                        ),
                    ),
                'uiColor' => '#ffffff',
                ),
            ))
        -> add('upperText', 'text', array('required' => true)) 
        -> add('lowerText', 'text', array('required' => true))
        -> add('file', 'file', array('required' => false)) 
        -> add('theme', 'entity', array(
            'class' => 'ProjectUserBundle:Theme',
            'property' => 'name',
            ))
        -> add('background', 'entity', array(
            'class' => 'ProjectUserBundle:Background',
            'property' => 'name',
            ))
        -> add('category', 'entity', array(
            'class' => 'ProjectUserBundle:Category',
            'empty_value' => 'Opcional',
            'property' => 'name',
            'label' => 'Categoria',
            'required' => false, 
            ))
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, )) 
        -> add('template', 'checkbox', array('label' => 'Plantilla', 'required' => false, )) 
        -> add('reservacion', 'checkbox', array('label' => 'Reservas', 'required' => false, )) 
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Page',
            ));
    }

    public function getName()
    {
        return 'page';
    }
}