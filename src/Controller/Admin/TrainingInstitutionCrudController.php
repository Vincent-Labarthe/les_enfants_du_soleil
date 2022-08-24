<?php

namespace App\Controller\Admin;

use App\Entity\TrainingInstitution;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TrainingInstitutionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TrainingInstitution::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Nom'),
            ChoiceField::new('type')->setLabel('Type')->setChoices([
                'enseignement primaire' => 'enseignement primaire',
                'enseignement secondaire' => 'enseignement secondaire',
                'apprentissage' => 'apprentissage',
                'entreprise recevant un stagiaire' => 'entreprise recevant un stagiaire',
                'université' => 'université',
            ]),
            TextField::new('speciality')->setLabel('Spécialité'),
            AssociationField::new('address')->setLabel('Adresse'),
            TelephoneField::new('tel')->setLabel('Téléphone'),
            AssociationField::new('correspondant')->setLabel('Correspondant'),
            TextEditorField::new('comment')->setLabel('Commentaire'),
        ];
    }

}
