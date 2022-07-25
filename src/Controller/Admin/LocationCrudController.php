<?php

namespace App\Controller\Admin;

use App\Entity\Location;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class LocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Location::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('person')->setLabel('Personne'),
            BooleanField::new('isCurrentLocation')->setLabel('Location actuelle ?'),
            DateField::new('locationStartedAt')->setLabel('Date de début'),
            DateField::new('locationEndedAt')->setLabel('Date de fin'),
            ChoiceField::new('type')->setLabel('Type')->setChoices([
                'interne' => 'interne',
                'externe' => 'externe',
            ]),
            AssociationField::new('address')->setLabel('Adresse'),
            AssociationField::new('edsEntity')->setLabel('Entité Eds'),
        ];
    }

}
