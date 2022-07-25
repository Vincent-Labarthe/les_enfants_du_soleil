<?php

namespace App\Controller\Admin;

use App\Entity\Origin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OriginCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Origin::class;
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
