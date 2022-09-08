<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, [
            'required' => true,
        ])->add('status', ChoiceType::class, [
                'choices' => [
                    'Salarié' => 'Actif',
                    'Prestataire' => 'Inactif',
                    'Autre' => 'Autre',
                ],
            ]);
    }
}
