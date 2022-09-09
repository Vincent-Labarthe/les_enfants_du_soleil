<?php

namespace App\Controller\Admin;

use App\Entity\EdsEntity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EdsEntityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EdsEntity::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            AssociationField::new('address', 'Adresse'),
            AssociationField::new('edsType')->setLabel('Type'),
            AssociationField::new('edsParent')->setLabel('Eds parent'),
            AssociationField::new('edsChildren')->setLabel('Eds enfant'),
            AssociationField::new('employees')->setLabel('Responsable'),
        ];
    }
}
