<?php

namespace App\Controller\Admin;

use App\Entity\BehaviorEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class BehaviorEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BehaviorEvent::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('eventBehaviorType')->setLabel('Evènement de comportement'),
            TextEditorField::new('comment')->setLabel('Commentaire'),
            AssociationField::new('person')->setLabel('Personne'),
        ];
    }
}
