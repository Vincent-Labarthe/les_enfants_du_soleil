<?php

namespace App\Controller\Admin;

use App\Entity\EdsEntity;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

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
            AssociationField::new('address','Adresse'),
            AssociationField::new('edsType')->setLabel('Type'),
            AssociationField::new('edsParent')->setLabel('Eds parent'),
            AssociationField::new('edsChildren')->setLabel('Eds enfant'),
            AssociationField::new('manager')->setLabel('Responsable'),
        ];
    }
}
