<?php

namespace Project\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name');
        //$builder->add('invitation', 'project_invitation_type');
        $builder->add('file');
        $builder->add('descripcion');
    }

    public function getName()
    {
        return 'project_user_registration';
    }
}