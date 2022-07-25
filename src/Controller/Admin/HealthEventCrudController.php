<?php

namespace App\Controller\Admin;

use App\Entity\HealthEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HealthEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HealthEvent::class;
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
