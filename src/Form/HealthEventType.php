<?php

namespace App\Form;

use App\Entity\HealthEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HealthEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isDisease')
            ->add('reason')
            ->add('diagnosis')
            ->add('analysis')
            ->add('imagery')
            ->add('treatment')
            ->add('comment')
            ->add('consultationCost')
            ->add('drugsCost')
            ->add('otherCost')
            ->add('beneficiary')
            ->add('eventMedicalType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HealthEvent::class,
        ]);
    }
}
