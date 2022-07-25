<?php

namespace App\Controller\Admin;

use App\Entity\Aid;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AidCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Aid::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('aidType')->setLabel('Type d\'aide'),
            DateField::new('startedAt')->setLabel('Date de début'),
            DateField::new('endedAt')->setLabel('Date de fin'),
            NumberField::new('annualAmount')->setLabel('Montant annuel'),
            AssociationField::new('person')->setLabel('Personne'),
        ];
    }

}
