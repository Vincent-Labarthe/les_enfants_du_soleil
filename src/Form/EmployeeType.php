<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        ])->add(
            'email', RepeatedType::class, [
                'type' => EmailType::class,
                'invalid_message' => 'Les adresses e-mails doivent être les mêmes, merci de vérifier votre saisie.',
                'options' => ['required' => true],
                'first_options' => [
                    'label' => 'Adresse e-mail ',
                    'attr' => ['class' => 'form-control form-control-lg', 'maxlength' => 70],
                ],
                'second_options' => [
                    'label' => 'Confirmation de l\'adresse e-mail',
                    'attr' => ['class' => 'form-control form-control-lg', 'maxlength' => 70],
                ],
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
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'translation_domain' => false,
            'data_class' => Employee::class,
        ]);
    }
}
