<?php

namespace App\Form;

use App\Entity\EdsEntity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class BeneficiaryLocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('edsEntity', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'required' => false,
            'placeholder' => 'Choisir une entité EDS',
        ])->add('supportStartedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => true,
            'label' => 'Date de début de prise en charge',
        ])->add('supportEndedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => false,
            'label' => 'Date de fin de prise en charge dans la précédente entité EDS (optionnel)',
        ]);
    }
}
