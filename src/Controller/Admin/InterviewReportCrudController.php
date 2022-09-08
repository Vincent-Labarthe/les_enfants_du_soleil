<?php

namespace App\Controller\Admin;

use App\Entity\InterviewReport;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class InterviewReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InterviewReport::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('report')->setLabel('Rapport'),
            AssociationField::new('beneficiary')->setLabel('Bénéficiaire'),
            AssociationField::new('manager')->setLabel('Responsable'),
        ];
    }
}
