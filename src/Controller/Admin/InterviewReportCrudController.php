<?php

namespace App\Controller\Admin;

use App\Entity\InterviewReport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InterviewReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InterviewReport::class;
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
