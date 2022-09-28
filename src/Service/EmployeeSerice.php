<?php

namespace App\Service;

use App\Entity\EdsEntity;
use App\Entity\Employee;
use App\Entity\GeneralIdentifier;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class EmployeeSerice
{

    public function __construct(private readonly BeneficiaryService $beneficiaryService, private readonly EntityManagerInterface $em)
    {
    }

    /**
     * Add new employee.
     *
     * @param array $formData Array of form data
     *
     * @return Employee
     */
    public function addEmployee(array $formData): Employee
    {
        $employee = new Employee();
        $generalIdentifier = new GeneralIdentifier();
        $generalIdentifier->setEmployee($employee);
        $employee->setGeneralIdentifier($generalIdentifier);
        $employee->setFirstName($formData['firstname']);
        $employee->setLastName($formData['lastname']);
        $employee->setGender($formData['gender']);
        $employee->setBirthDate($formData['birthdate']);
        $employee->setTel($formData['tel']);
        $employee->setStartedAt($formData['startDate']);
        $employee->setEndedAt($formData['endDate']);
        $employee->setEmail($formData['email']);
        $employee->setStatus($formData['status']);
        $employee->addEdsEntity($this->em->getRepository(EdsEntity::class)->find($formData['edsEntity']));
        if ($imageFile = $formData['imageUrl']) {
            $this->beneficiaryService->saveProfilImage($imageFile, $employee);
        }

        $this->em->persist($employee);
        $this->em->flush();

        return $employee;
    }

    /**
     * Get active employees.
     *
     * @return array|null
     */
    public function getActiveEmployees()
    {
        $personCollection = $this->em->getRepository(Employee::class)->getActiveEmployees();
        $personsData = new Collection($personCollection, new ArrayTransformer());
        $fractal = new Manager();

        return $fractal->createData($personsData)->toArray();
    }
}