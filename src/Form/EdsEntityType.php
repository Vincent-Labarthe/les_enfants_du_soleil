<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\EdsType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EdsEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('address', AddressType::class, [
            'label' => 'Adresse de l\'entité',
        ])->add('parent', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'label' => false,
            'placeholder' => 'Entité parente',
        ])->add('type', EntityType::class, [
            'class' => EdsType::class,
            'choice_label' => 'type',
            'placeholder' => 'Type d\'entité',
            'label' => false,
            'required' => true,
        ]);
    }
}
