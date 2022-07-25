<?php

namespace App\Controller\Admin;

use App\Entity\TrainingInstitution;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TrainingInstitutionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TrainingInstitution::class;
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
