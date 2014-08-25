<?php

namespace Project\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SettingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('name', 'text', array('label' => 'Nombre','required' => true))
        -> add('value', 'text', array('label' => 'Valor','required' => true))
        -> add('published', 'checkbox', array('label' => 'Publicado', 'required' => false, 'attr' => array('class' => 'ace-switch') ))
        -> add('save', 'submit',array('label' => 'Guardar', 'attr' => array('class' => 'btn btn-info')))
        -> getForm();
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Project\UserBundle\Entity\Setting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'setting';
    }
}