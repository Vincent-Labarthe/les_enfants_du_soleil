<?php

namespace App\Controller\Admin;

use App\Entity\EventBehaviorType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventBehaviorTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventBehaviorType::class;
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
