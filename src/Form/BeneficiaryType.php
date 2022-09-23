<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\Origin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeneficiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
        ])->add('lastName', TextType::class, [
            'label' => 'Nom',
        ])->add('internRef', TextType::class, [
            'label' => 'Référence interne'
        ])->add('email', EmailType::class, [
            'label' => 'Email',
            'required' => false,
        ])->add('sexe', ChoiceType::class, [
            'choices' => [
                'Masculin' => 'H',
                'Féminin' => 'F',
            ],
            'required' => true,
            'expanded' => false,
        ])->add('dateOfBirth', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('origin', EntityType::class, [
            'class' => Origin::class,
            'choice_label' => 'type',
            'required' => true,
            'placeholder' => 'Choisir un statut',
        ])->add('imageUrl', FileType::class, [
            'required' => false,
            'label' => 'Image URL',
            'data_class' => null,
        ])->add('birthCertificate', FileType::class, [
            'required' => false,
            'label' => 'Certificat de naissance',
            'data_class' => null,
        ])->add('refOrdonnance', TextType::class, [
            'required' => true,
            'label' => 'Référence de l\'ordonnance de placement',
        ])->add('supportStartedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => false,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('supportEndedAt', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => false,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('lifeProject', CheckboxType::class, [
            'required' => false,
            'label' => 'Projet de vie',
        ])->add('plannedCareer', TextType::class, [
            'required' => false,
            'label' => 'Plan de carrière',
        ])->add('tel', TextType::class)->add('edsEntity', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'required' => false,
            'placeholder' => 'Choisir une entité',
            'mapped' => false,
        ]);

        $builder->get('imageUrl')->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            if (null === $event->getData()) {
                $event->setData($event->getForm()->getData());
            }
        });

        $builder->get('birthCertificate')->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            if (null === $event->getData()) {
                $event->setData($event->getForm()->getData());
            }
        });
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => false,
        ]);
    }
}
