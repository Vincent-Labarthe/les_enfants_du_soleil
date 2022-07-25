<?php

namespace App\Controller\Admin;

use App\Entity\EdsType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EdsTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EdsType::class;
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
