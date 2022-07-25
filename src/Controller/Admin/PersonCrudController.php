<?php

namespace App\Controller\Admin;

use App\Entity\Person;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PersonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Person::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname')->setLabel('Prénom'),
            TextField::new('lastname')->setLabel('Nom de famille'),
            ChoiceField::new('sexe')->setLabel('Genre')->setChoices(['Homme' => 'M', 'Femme' => 'F']),
            AssociationField::new('origin')->setLabel('Origine'),
            DateField::new('dateOfBirth')->setLabel('Date de naissance'),
            TextField::new('familyRelation')->setLabel('Rélation familiale'),
            EmailField::new('email')->setLabel('Email'),
            TelephoneField::new('tel')->setLabel('Téléphone'),
            ImageField::new('image_url')->setLabel('Image')->setUploadDir('/public/images/person'),
            DateField::new('supportStartedAt')->setLabel('Date de début du support'),
            DateField::new('supportEndedAt')->setLabel('Date de fin du support'),
            AssociationField::new('correspondantTrainingInstitution')->setLabel('Correspondant de formation'),
            AssociationField::new('trainingInstitution')->setLabel('Institution de formation'),
            AssociationField::new('schoolLevel')->setLabel('Niveau scolaire'),
            AssociationField::new('degree')->setLabel('Diplôme'),
        ];
    }

}
