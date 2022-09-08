<?php

namespace App\Controller\Admin;

use App\Entity\HealthEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HealthEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HealthEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           BooleanField::new('isDisease')->setLabel('Maladie ?'),
            AssociationField::new('eventMedicalType')->setLabel('Type de consultation'),
            AssociationField::new('person')->setLabel('Patient'),
            TextField::new('reason')->setLabel('Raison'),
            TextField::new('diagnosis')->setLabel('Diagnostic'),
            TextField::new('analysis')->setLabel('Analyse'),
            ImageField::new('imagery')->setLabel('Imagerie')->setUploadDir('/public/images/person'),
            TextField::new('treatment')->setLabel('Traitement'),
            TextEditorField::new('comment')->setLabel('Commentaire'),
            NumberField::new('consultationCost')->setLabel('Coût de consultation'),
            NumberField::new('drugsCost')->setLabel('Coût de médicament'),
            NumberField::new('otherCost')->setLabel('Coût autre'),
        ];
    }
}
