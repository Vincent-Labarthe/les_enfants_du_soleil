<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompanyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Company::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom de la société'),
            TextField::new('type')->setLabel('Type de société'),
            TelephoneField::new('tel')->setLabel('Téléphone'),
            TextEditorField::new('comment')->setLabel('Commentaire'),
            TextField::new('Activity')->setLabel('Activité'),
            AssociationField::new('address')->setLabel('Adresse'),
            AssociationField::new('correspondent')->setLabel('Correspondant'),
        ];
    }
}
