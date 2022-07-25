<?php

namespace App\Controller\Admin;

use App\Entity\Sponsorship;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SponsorshipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sponsorship::class;
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
