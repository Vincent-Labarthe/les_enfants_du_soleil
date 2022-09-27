<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\GeneralIdentifier;
use App\Form\EmployeeSearchType;
use App\Form\EmployeeType;
use App\Service\EdsEntityService;
use App\Service\EmployeeSerice;
use App\Transformer\Employee\DetailToArrayTransformer;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/employee', name: 'app_employee_')]
class EmployeeController extends AbstractController
{
    #[Route(name: 'index')]
    public function index(EntityManagerInterface $em, EdsEntityService $edsEntityService): Response
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
            'form' => $form->createView(),
            'parentEdsEntities' => $edsEntityService->getParentEdsEntity(),
        ]);
    }

    /**
     * @return Response
     */
    #[Route(path: '/add', name: 'add')]
    public function add(Request $request, EdsEntityService $edsEntityService, EmployeeSerice $employeeSerice)
    {
        $form = $this->createForm(EmployeeType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employeeSerice->addEmployee($form->getData());

            return $this->redirectToRoute('app_employee_index');
        }

        return $this->render('employee/add.html.twig', [
            'form' => $form->createView(),
            'parentEdsEntities' => $edsEntityService->getParentEdsEntity(),

        ]);
    }

    /**
     *
     */
    #[Route(path: '/detail/{id}', name: 'detail', options: ['expose' => true])]
    public function detail(Employee $employee)
    {
        if (!$personData = new Item($employee, new DetailToArrayTransformer())) {
            throw $this->createNotFoundException('Person not found');
        }

        $fractal = new Manager();
        $employeeArray = $fractal->createData($personData)->toArray();

        return $this->render('employee/detail.html.twig', [
            'person' => $employeeArray,
        ]);
    }

    /**
     *
     */
    #[Route(path: '/edit/{id}', name: 'edit', options: ['expose' => true])]
    public function edit(Employee $employee)
    {
        if (!$personData = new Item($employee, new DetailToArrayTransformer())) {
            throw $this->createNotFoundException('Person not found');
        }

        $fractal = new Manager();
        $employeeArray = $fractal->createData($personData)->toArray();

        return $this->render('employee/detail.html.twig', [
            'person' => $employeeArray,
        ]);
    }
}
