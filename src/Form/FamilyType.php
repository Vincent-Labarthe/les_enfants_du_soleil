<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\SchoolLevel;

class FamilyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class,[
                'label' => 'Prénom',
                'required' => true,
            ])->add('lastname', TextType::class,[
                'label' => 'Nom',
                'required' => true,
            ])->add('relation', TextType::class,[
                'label' => 'Relation',
                'required' => true,
            ])->add('schoolLevel', EntityType::class,[
                'label' => 'Niveau scolaire',
                'class' => SchoolLevel::class,
            ])->add('job', TextType::class,[
                'label' => 'Profession',
                'required' => false,
            ]);
    }
}