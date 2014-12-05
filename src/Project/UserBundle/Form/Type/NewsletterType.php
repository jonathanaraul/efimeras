<?php

namespace Project\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsletterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('asunto', 'text', array('label' => 'Asunto','required' => true))
        -> add('contenido', 'ckeditor', array(
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
                    'route'            => 'project_front_modal_message',
                    'route_parameters' => array(
                        'type' => 'image',
                    ),
                ),
            ))
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        -> getForm();
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Newsletter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'newsletter';
    }
}