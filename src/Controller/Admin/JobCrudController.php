<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Job::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('type')->setLabel('Type de contrat')->setChoices([
                'CDI' => 'CDI',
                'CDD' => 'CDD',
                'Stage' => 'Stage',
                'Freelance' => 'Freelance',
                'Autre' => 'Autre',
            ]),
            TextField::new('name')->setLabel('Nom du métier'),
            NumberField::new('annualSalary')->setLabel('Salaire annuel'),
            AssociationField::new('company')->setLabel('Société'),
            AssociationField::new('person')->setLabel('Personne'),
            DateField::new('startedAt')->setLabel('Date de début'),
            DateField::new('endedAt')->setLabel('Date de fin'),
        ];
    }

}
