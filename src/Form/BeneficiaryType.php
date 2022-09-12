<?php

namespace App\Form;

use App\Entity\Beneficiary;
use App\Entity\EdsEntity;
use App\Entity\Origin;
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

class BeneficiaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
        ])->add('lastName', TextType::class, [
            'label' => 'Nom',
        ])->add(
            'email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Les adresses e-mails doivent être les mêmes, merci de vérifier votre saisie.',
                'options' => ['required' => true],
                'first_options' => [
                    'label' => 'Adresse e-mail ',
                    'attr' => ['class' => 'form-control ', 'maxlength' => 70],
                ],
                'second_options' => [
                    'label' => 'Confirmation de l\'adresse e-mail',
                    'attr' => ['class' => 'form-control ', 'maxlength' => 70],
                ],
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ e-mail est obligatoire.']),
                    new Length(['max' => 70]),
                ],
                'attr' => ['class' => 'form-control '],
            ]
        )->add('sexe', ChoiceType::class, [
            'choices' => [
                'Homme' => 'H',
                'Femme' => 'F',
            ],
            'required' => true,
            'expanded' => false,
        ])->add('dateOfBirth', DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
        ])->add('status', EntityType::class, [
            'class' => Origin::class,
            'choice_label' => 'type',
            'required' => false,
            'placeholder' => 'Choisir un statut',
        ])->add('imageUrl', FileType::class, [
            'required' => false,
            'label' => 'Image URL',
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
        ])->add('tel', TextType::class)->add('edsEntity', EntityType::class, [
                'class' => EdsEntity::class,
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Choisir une entité',
            ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => false,
            'data_class' => Beneficiary::class,
        ]);
    }
}
