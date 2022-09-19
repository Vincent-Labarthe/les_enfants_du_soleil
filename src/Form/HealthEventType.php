<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\EventMedicalType;

class HealthEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('isDisease', CheckboxType::class, [
                'label' => 'Maladie ?',
                'required' => false,
            ])->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'js-datepicker',
                ],
                'required' => true,
            ])->add('reason', null, [
                'required' => false,
                'label' => 'Raison ',
            ])->add('diagnosis', null, [
                'required' => false,
                'label' => 'Diagnostic ',
            ])->add('analysis', null, [
                'required' => false,
                'label' => 'Analyse ',
            ])->add('imagery', null, [
                'required' => false,
                'label' => 'Imagerie ',
            ])->add('treatment', null, [
                'required' => false,
                'label' => 'Traitement ',
            ])->add('comment', null, [
                'required' => false,
                'label' => 'Commentaire ',
            ])->add('consultationCost', null, [
                'required' => false,
                'label' => 'Coût de la consultation ',
            ])->add('drugsCost', null, [
                'required' => false,
                'label' => 'Coût des médicaments ',
            ])->add('otherCost', null, [
                'required' => false,
                'label' => 'Autres coûts ',
            ])->add('eventMedicalType', EntityType::class, [
                'class' => EventMedicalType::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Type de consultation ',
            ]);
    }
}
