<?php

namespace App\Form;

use App\Entity\BehaviorEvent;
use App\Entity\EventBehaviorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class BehaviourEventType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, [
                'required' => false,
                'label' => 'Commentaire ',
            ])->add('date',DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'attr' => [
                    'class' => 'js-datepicker',
                ],
                'required' => true,
            ])->add('eventBehaviorType', EntityType::class, [
                'class' => EventBehaviorType::class,
                'choice_label' => 'type',
                'required' => true,
                'label' => 'Type d\'évènement ',
            ]);
    }
}
