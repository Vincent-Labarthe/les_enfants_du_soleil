<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('street', TextType::class, [
            'required' => true,
            'label' => 'Rue',
        ])
        ->add('zip', TextType::class, [
            'required' => true,
            'label' => 'Code postal',
        ])
        ->add('city', TextType::class, [
            'required' => true,
            'label' => 'Ville',
        ])
        ->add('country', TextType::class, [
            'required' => true,
            'label' => 'Pays',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
