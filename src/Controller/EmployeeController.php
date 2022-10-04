<?php

namespace App\Controller;

use App\Entity\Beneficiary;
use App\Entity\Employee;
use App\Entity\EmployeeFunction;
use App\Entity\Formation;
use App\Entity\GeneralIdentifier;
use App\Entity\HealthEvent;
use App\Form\EmployeeSearchType;
use App\Form\EmployeeType;
use App\Form\FormationType;
use App\Form\FunctionType;
use App\Service\EdsEntityService;
use App\Service\EmployeeService;
use App\Transformer\Employee\DetailToArrayTransformer;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
    public function add(Request $request, EdsEntityService $edsEntityService, EmployeeService $employeeSerice)
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

    /**
     * Ajax call to display employee function history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/function/ajax', name: 'function_ajax', options: ['expose' => true], methods: ['POST'])]
    public function functionAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$employee = $em->getRepository(Employee::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_employee_index');
        }
        $functions = $employee->getFunctions()->toArray();
        $html = $this->render('employee/_include/_functions.html.twig', [
            'functions' => $functions !== [] ? $functions : null,
            'person' => $employee,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * function add page.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/function/add', name: 'function_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function functionAdd(
        Request $request,
        EntityManagerInterface $em,
        EmployeeService $employeeService
    ): RedirectResponse|JsonResponse|Response {
        if (!$employee = $em->getRepository(Employee::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(FunctionType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employeeService->addFunction($employee, $form->getData());

            return $this->redirectToRoute('app_employee_detail', ['id' => $employee->getId()]);
        }

        $html = $this->render('employee/form/_add_function.html.twig', [
            'form' => $form->createView(),
            'person' => $employee,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing an employee's function.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/function/delete', name: 'function_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function functionDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $employee = $em->getRepository(Employee::class)->find($request->query->get('id'));
        $employeeFunction = $em->getRepository(EmployeeFunction::class)->find($request->query->get('functionId'));
        $employee?->removeFunction($employeeFunction);
        $em->remove($employeeFunction);
        $em->flush();

        return new JsonResponse();
    }

    /**
     * Ajax call to display employee formation history.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return JsonResponse|RedirectResponse
     */
    #[Route(path: '/formation/ajax', name: 'formation_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationAjax(Request $request, EntityManagerInterface $em): RedirectResponse|JsonResponse
    {
        if (!$employee = $em->getRepository(Employee::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_employee_index');
        }
        $formations = $employee->getFormation()->toArray();

        $html = $this->render('employee/_include/_formations.html.twig', [
            'formations' => $formations !== [] ? $formations : null,
            'person' => $employee,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * formation add page.
     *
     * @param Request                $request Current request
     * @param EntityManagerInterface $em      The entity manager
     *
     * @return RedirectResponse|JsonResponse|Response
     */
    #[Route(path: '/formation/add', name: 'formation_add_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationAdd(
        Request $request,
        EntityManagerInterface $em,
        EmployeeService $employeeService
    ): RedirectResponse|JsonResponse|Response {
        if (!$employee = $em->getRepository(Employee::class)->find($request->query->get('id'))) {
            return $this->redirectToRoute('app_beneficiary_index');
        }

        $form = $this->createForm(FormationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $employeeService->addFormation($employee, $form->getData());

            return $this->redirectToRoute('app_employee_detail', ['id' => $employee->getId()]);
        }

        $html = $this->render('employee/form/_add_formation.html.twig', [
            'form' => $form->createView(),
            'person' => $employee,
        ]);

        return new JsonResponse($html->getContent());
    }

    /**
     * Removing an employee's formation.
     *
     * @param EntityManagerInterface $em      The entity manager
     * @param Request                $request Current request
     *
     * @return JsonResponse
     */
    #[Route(path: '/formation/delete', name: 'formation_delete_ajax', options: ['expose' => true], methods: ['POST'])]
    public function formationDelete(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $employee = $em->getRepository(Employee::class)->find($request->query->get('id'));
        $employee?->removeFormation($em->getRepository(Formation::class)->find($request->query->get('formationId')));
        $em->flush();

        return new JsonResponse();
    }
}
