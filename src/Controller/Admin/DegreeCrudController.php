<?php

namespace App\Controller\Admin;

use App\Entity\Degree;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DegreeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Degree::class;
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
