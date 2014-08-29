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

        -> add('name', 'text', array('label' => 'Nombre','required' => true, 'attr' => array('class' => 'span6')))
        -> add('descriptionMeta', 'textarea', array('label' => 'Descripcion meta','required' => true, 'attr' => array('class' => 'span6'))) 
        -> add('keywords', 'text', array('label' => 'Palabras claves','required' => true, 'attr' => array('class' => 'span6'))) 
        -> add('upperText', 'text', array('label'=> 'Texto cabecera','required' => true, 'attr' => array('class' => 'span6'))) 
        -> add('lowerText', 'text', array('label'=> 'Texto inferior','required' => true, 'attr' => array('class' => 'span6')))   
        -> add('file', 'file', array('label'=> 'Archivo opcional','required' => false))      
        -> add('tags', 'text', array('label' => 'Etiquetas','required' => true))
        -> add('reservacion', 'checkbox', array('label' => 'Reservas', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('template', 'checkbox', array('label' => 'Plantilla Tags', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('templateMenu', 'checkbox', array('label' => 'Plantilla Menus', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('content', 'ckeditor', array(
            'label' => 'Nombre',
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
        -> add('background', 'entity', array(
            'class' => 'ProjectUserBundle:Background',
            'property' => 'name',
            'label' => 'Fondo',
            'required' => true, 
            ))
        -> add('theme', 'entity', array(
            'class' => 'ProjectUserBundle:Theme',
            'property' => 'name',
            'label' => 'Tema',
            'required' => true, 
            ))
        -> add('category', 'entity', array(
            'class' => 'ProjectUserBundle:Category',
            'empty_value' => 'Opcional',
            'property' => 'name',
            'label' => 'Categoria',
            'required' => false, 
            ))
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