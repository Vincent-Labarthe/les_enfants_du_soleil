<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom de la formation'),
            TextField::new('specialty')->setLabel('Spécialité'),
            TextField::new('result')->setLabel('Résultat'),
            TextField::new('suggestedDirection')->setLabel('Orientation suggérée'),
            DateField::new('startedAt')->setLabel('Date de début'),
            DateField::new('endedAt')->setLabel('Date de fin'),
            AssociationField::new('trainingInstitution')->setLabel('Institution de formation'),
            AssociationField::new('student')->setLabel('Personne suivant la formation'),
            AssociationField::new('className')->setLabel('Classe'),
        ];
    }
}
