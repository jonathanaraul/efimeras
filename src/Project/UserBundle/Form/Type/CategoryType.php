<?php

// src/Project/UserBundle/Form/Type/PageType.php
namespace Project\UserBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
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
        -> add('template', 'checkbox', array('label' => 'Plantilla Tags', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('templateMenu', 'checkbox', array('label' => 'Plantilla Menus', 'required' => false, 'attr' => array('class' => 'ace-switch') ))        
        -> add('menu', 'entity', array(
            'class' => 'ProjectUserBundle:Menu',
            'empty_value' => 'Ninguno',
            'property' => 'name',
            'label' => 'Menu',
            'required' => false, 
            ))    
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') )) 
        -> add('content', 'ckeditor', array(
                'label' => 'Contenido',
                'transformers'                 => array('html_purifier'),
                'toolbar'                      => array('document', 'clipboard', 'editing', '/', 'basicstyles', 'paragraph', 'links', '/', 'insert', 'styles', 'tools'),
                'toolbar_groups'               => array(
                    'document' => array('Source')
                ),
                'ui_color'                     => '#000000',
                'startup_outline_blocks'       => false,
                'width'                        => '100%',
                'height'                       => '320',
                'language'                     => 'es-es',
                'filebrowser_image_browse_url' => array(
                    'url' => 'relative-url.php?type=file',
                ),
                'filebrowser_image_browse_url' => array(
                    'route'            => 'project_back_imagelink_list',
                    'route_parameters' => array(
                        'type' => 'image',
                    ),
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
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')));

   }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Category',
            ));
    }

    public function getName()
    {
        return 'category';
    }
}