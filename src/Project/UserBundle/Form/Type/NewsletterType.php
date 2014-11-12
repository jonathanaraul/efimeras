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
                        'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat', '-',  '-',  '-',  '-', 'Link'),
                        ),
                    ),
                'uiColor' => '#ffffff',
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