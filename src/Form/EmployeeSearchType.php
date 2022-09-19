<?php

namespace App\Form;

use App\Entity\EdsEntity;
use App\Entity\Origin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EmployeeSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'required' => false,
        ])->add('lastName', TextType::class, [
            'label' => 'Nom',
            'required' => false,
        ])->add('origin', EntityType::class, [
            'class' => Origin::class,
            'label' => 'Type',
            'choice_label' => 'type',
            'required' => false,
        ])->add('edsEntity', EntityType::class, [
            'class' => EdsEntity::class,
            'choice_label' => 'name',
            'required' => false,
            'label' => 'Choisir une entité EDS',
        ])->add('function', TextType::class);
    }
}
