<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\Origin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'required' => false,
        ])->add('lastName', TextType::class, [
            'label' => 'Nom',
            'required' => false,
        ])->add('dateOfBirth', DateType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text',
            'html5' => true,
            'attr' => ['class' => 'js-datepicker'],
            'required' => false,
        ])->add('sexe', ChoiceType::class, [
            'label' => 'Genre',
            'choices' => [
                'Homme' => 'H',
                'Femme' => 'F',
            ],
            'required' => false,
        ])->add('origin', EntityType::class, [
            'class' => Origin::class,
            'label' => 'Type de bénéficaire',
            'choice_label' => 'type',
            'required' => false,
        ])->add('edsEntity', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'required' => false,
            'placeholder' => 'Choisir une entité EDS',
        ]);
    }
}