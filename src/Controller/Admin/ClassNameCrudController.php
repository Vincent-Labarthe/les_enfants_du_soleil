<?php

namespace App\Controller\Admin;

use App\Entity\ClassName;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClassNameCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClassName::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
