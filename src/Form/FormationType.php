<?php

namespace App\Form;

use App\Entity\TrainingInstitution;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\ClassName;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('class_name', EntityType::class, [
            'class' => ClassName::class,
            'choice_label' => 'name',
            'label' => 'Classe',
            'required' => false,
        ])->add('name', TextType::class, [
            'label' => 'Nom de la formation',
        ])->add('result', ChoiceType::class, [
            'choices' => [
                'Formation réussie' => 'OK',
                'Formation non réussie' => 'KO',
            ],
            'label' => 'Résultat',
        ])->add('speciality', TextType::class, [
            'label' => 'Spécialité',
        ])->add('started_at',DateType::class, [
            'label' => 'Date de début',
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('ended_at',DateType::class, [
            'label' => 'Date de fin',
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => false,
        ])->add('suggested_direction',TextType::class,[
            'label' => 'Orientation suggérée',
            'required' => false,
        ])->add('training_institution', EntityType::class,[
            'class' => TrainingInstitution::class,
            'choice_label' => 'name',
            'label' => 'Institut de formation',
            'required' => false,
        ]);

    }


}