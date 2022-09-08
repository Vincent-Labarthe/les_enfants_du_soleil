<?php

namespace App\Controller\Admin;

use App\Entity\AidType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AidTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AidType::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Category')->setLabel('Categorie'),
            TextEditorField::new('description')->setLabel('Description'),
        ];
    }
}
