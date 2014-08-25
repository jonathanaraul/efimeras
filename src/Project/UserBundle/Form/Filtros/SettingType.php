<?php

namespace Project\UserBundle\Form\Filtros;

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
        -> add('name', 'text', array('label' => 'Nombre','required' => false))
        -> add('value', 'text', array('label' => 'Valor','required' => false))
        -> add('published', 'choice', array(
            'choices'   => array( -1 =>'',0 => 'No', 1 => 'Si'),
            'label' => 'Publicado',
            'required'  => true,
            )) 
        -> add('save', 'submit',array('label' => 'Buscar', 'attr' => array('class' => 'btn btn-info')))
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
        return 'setting_filtro';
    }
}