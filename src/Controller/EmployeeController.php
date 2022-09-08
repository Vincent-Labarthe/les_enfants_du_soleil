<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/employe", name="app_employee_")
 */
class EmployeeController extends AbstractController
{
    /**
     * @Route(name="index")
     *
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        $data = new Collection($em->getRepository(Employee::class)->findAll(), new ArrayTransformer());
        $fractal = new Manager();

        return $this->render('employee/index.html.twig', [
            'employees' => $fractal->createData($data)->toArray()['data']
        ]);
    }

    /**
     * @Route("/ajouter", name="add")
     *
     * @return Response
     */
    public function add()
    {
        $form = $this->createForm(EmployeeType::class, new Employee());

        return $this->render('employee/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
