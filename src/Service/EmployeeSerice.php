<?php

namespace App\Service;

use App\Entity\EdsEntity;
use App\Entity\Employee;
use App\Entity\GeneralIdentifier;
use Doctrine\ORM\EntityManagerInterface;

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
        $employee->setFirstName($formData['firstname']);
        $employee->setLastName($formData['lastname']);
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
}