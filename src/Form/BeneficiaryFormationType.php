<?php

namespace App\Form;

use App\Entity\ClassName;
use App\Entity\TrainingInstitution;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BeneficiaryFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('className', EntityType::class, [
            'class' => ClassName::class,
            'choice_label' => 'name',
            'required' => true,
            'label' => 'Niveau de formation',
        ])->add('specialty', TextType::class, [
            'label' => 'Spécialité',
            'required' => true,
        ])->add('result', TextType::class, [
            'label' => 'Résultat',
            'required' => true,
        ])->add('suggestedDirection', TextType::class, [
            'label' => 'Orientation suggérée',
            'required' => true,
        ])->add('startedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => true,
            'label' => 'Date de début',
        ])->add('endedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => false,
            'label' => 'Date de fin',
        ])->add('trainingInstitution', EntityType::class, [
            'class' => TrainingInstitution::class,
            'choice_label' => 'name',
            'required' => false,
            'label' => 'Organisme de formation',
        ]);
    }
}
