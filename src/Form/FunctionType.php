<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\EdsEntity;

class FunctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('function_name', TextType::class, [
            'label' => 'Fonction employé',
            'required' => true,
        ])->add('status', ChoiceType::class, [
            'label' => 'Statut',
            'choices' => [
                'Employé' => 'employee',
                'Prestataire' => 'supplier',
            ],
            'required' => true,
        ])->add('started_at', DateType::class, [
            'label' => 'Date de début',
            'required' => true,
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('ended_at', DateType::class, [
            'label' => 'Date de fin',
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => false,
        ])->add('eds_entity', EntityType::class, [
            'class' => EdsEntity::class,
            'label' => 'Entité EDS',
            'required' => true,
        ]);
    }

}