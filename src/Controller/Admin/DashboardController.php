<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Aid;
use App\Entity\AidType;
use App\Entity\BehaviorEvent;
use App\Entity\Beneficiary;
use App\Entity\ClassName;
use App\Entity\Company;
use App\Entity\Degree;
use App\Entity\EdsEntity;
use App\Entity\EdsType;
use App\Entity\EventBehaviorType;
use App\Entity\EventMedicalType;
use App\Entity\Formation;
use App\Entity\HealthEvent;
use App\Entity\InterviewReport;
use App\Entity\Job;
use App\Entity\Origin;
use App\Entity\SchoolLevel;
use App\Entity\Sponsorship;
use App\Entity\TrainingInstitution;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(BeneficiaryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Les Enfants du Soleil');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Personne');
        yield MenuItem::linkToCrud('Personne', 'fas fa-list', Beneficiary::class);
        yield MenuItem::linkToCrud('Origine', 'fas fa-list', Origin::class);
        yield MenuItem::linkToCrud('Rapport d\'entretien', 'fas fa-list', InterviewReport::class);
        yield MenuItem::linkToCrud('Métier', 'fas fa-list', Job::class);

        yield MenuItem::section('Evènement');
        yield MenuItem::linkToCrud('Evenement de santé', 'fas fa-list', HealthEvent::class);
        yield MenuItem::linkToCrud('Evenement de comportement', 'fas fa-list', BehaviorEvent::class);

        yield MenuItem::section('Formation');
        yield MenuItem::linkToCrud('Classe', 'fas fa-list', ClassName::class);
        yield MenuItem::linkToCrud('Entreprise', 'fas fa-list', Company::class);
        yield MenuItem::linkToCrud('Diplôme', 'fas fa-list', Degree::class);
        yield MenuItem::linkToCrud('Organisme de formation', 'fas fa-list', TrainingInstitution::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-list', Formation::class);
        yield MenuItem::linkToCrud('Niveau scolaire', 'fas fa-list', SchoolLevel::class);

        yield MenuItem::section('Localisation');
        yield MenuItem::linkToCrud('Entité Eds', 'fas fa-list', EdsEntity::class);
        yield MenuItem::linkToCrud('Adresse', 'fas fa-list', Address::class);
        yield MenuItem::linkToCrud('Aide', 'fas fa-list', Aid::class);

        yield MenuItem::section('Type de données');
        yield MenuItem::linkToCrud('Type d\'aide', 'fas fa-list', AidType::class);
        yield MenuItem::linkToCrud('Type d\'entité Eds', 'fas fa-list', EdsType::class);
        yield MenuItem::linkToCrud('Type d\'evenement de comportement', 'fas fa-list', EventBehaviorType::class);
        yield MenuItem::linkToCrud('Type d\'evenement de santé', 'fas fa-list', EventMedicalType::class);

        yield MenuItem::section('Autre');
        yield MenuItem::linkToCrud('Parrainage', 'fas fa-list', Sponsorship::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
