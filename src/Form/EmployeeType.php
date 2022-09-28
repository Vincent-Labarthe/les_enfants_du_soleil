<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Length;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, [
            'required' => true,
        ])->add('lastname', TextType::class, [
            'required' => true,
        ])->add('gender', ChoiceType::class, [
            'choices' => [
                'Masculin' => 'H',
                'Féminin' => 'F',
            ],
            'required' => true,
        ])->add('birthdate', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'label' => 'Date de naissance',
        ])->add('tel', TextType::class, [
            'required' => false,
            'label' => 'Téléphone',
            'constraints' => [
                new Length([
                    'min' => 10,
                    'max' => 10,
                    'minMessage' => 'Votre numéro de téléphone doit contenir au moins {{ limit }} chiffres',
                    'maxMessage' => 'Votre numéro de téléphone doit contenir au plus {{ limit }} chiffres',
                ]),
            ],
        ])->add(
            'email', EmailType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ e-mail est obligatoire.']),
                    new Length(['max' => 70]),
                ],
                'attr' => ['class' => 'form-control form-control-lg'],
            ]
        )->add('status', ChoiceType::class, [
            'choices' => [
                'Salarié' => 'Actif',
                'Prestataire' => 'Inactif',
                'Autre' => 'Autre',
            ],
        ])->add('imageUrl', FileType::class, [
            'required' => false,
            'label' => 'Image URL',
        ])->add('edsEntity', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'required' => false,
            'placeholder' => 'Choisir une entité',
        ])->add('startDate', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'label' => 'Date d\'embauche',
        ])->add('endDate', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'required' => false,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'label' => 'Date de fin de contrat',
        ]);
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
