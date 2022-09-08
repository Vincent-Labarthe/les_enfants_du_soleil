<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('street')->setLabel('Rue'),
            TextField::new('zip')->setLabel('Code postal'),
            TextField::new('city')->setLabel('Ville'),
            TextField::new('country')->setLabel('Pays'),
        ];
    }
}
