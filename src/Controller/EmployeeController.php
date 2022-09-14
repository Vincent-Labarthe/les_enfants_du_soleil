<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\EmployeeSearchType;
use App\Form\EmployeeType;
use App\Form\BeneficiarySearchType;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/employe', name: 'app_employee_')]
class EmployeeController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EmployeeSearchType::class);
        if ($form->isSubmitted() && $form->isValid()) {
            $users = $em->getRepository(Employee::class)->search($form->getData());
        }

        if (!isset($users)) {
            $users = $em->getRepository(Employee::class)->findAll();
        }

        $data = new Collection($users, new ArrayTransformer());
        $fractal = new Manager();

        return $this->render('employee/index.html.twig', [
            'employees' => $fractal->createData($data)->toArray()['data'],
            'form' => $form->createView()
        ]);
    }

    /**
     * @return Response
     */
    #[Route(path: '/ajouter', name: 'add')]
    public function add()
    {

        $form = $this->createForm(EmployeeType::class);

        return $this->render('employee/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
