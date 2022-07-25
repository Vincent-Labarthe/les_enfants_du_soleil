<?php

namespace App\Controller\Admin;

use App\Entity\EventMedicalType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventMedicalTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventMedicalType::class;
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
