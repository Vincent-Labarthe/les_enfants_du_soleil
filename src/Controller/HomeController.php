<?php

namespace App\Controller;

use App\Service\BeneficiaryService;
use App\Service\EdsEntityService;
use App\Service\EmployeeSerice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'app_home')]
    public function index(BeneficiaryService $beneficiaryService, EdsEntityService $edsEntityService, EmployeeSerice $employeeSerice): Response
    {
        return $this->render('home/index.html.twig', [
            'persons' => $beneficiaryService->getSupportedPerson(),
            'employees' => $employeeSerice->getActiveEmployees(),
            'parentEdsEntities' => $edsEntityService->getParentEdsEntity(),
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout', methods: ['GET'])]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
