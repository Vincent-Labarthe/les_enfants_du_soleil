<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class InterviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('report',TextareaType::class, [
            'required' => true,
            'label' => 'Rapport ',
        ])->add('eventDate',DateType::class, [
            'widget' => 'single_text',
            'html5' => true,
            'attr' => [
                'class' => 'js-datepicker',
            ],
            'required' => true,
        ])->add('manager', EntityType::class, [
            'class' => Employee::class,
            'choice_label' => 'firstname',
            'required' => true,
            'label' => 'Responsable',
        ]);
    }
}