<?php

namespace App\Service;

use App\Entity\ClassName;
use App\Entity\EdsEntity;
use App\Entity\Employee;
use App\Entity\EmployeeFunction;
use App\Entity\Formation;
use App\Entity\GeneralIdentifier;
use App\Entity\TrainingInstitution;
use App\Transformer\Employee\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class EmployeeService
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
    public function getActiveEmployees(): ?array
    {
        $personCollection = $this->em->getRepository(Employee::class)->getActiveEmployees();
        $personsData = new Collection($personCollection, new ArrayTransformer());
        $fractal = new Manager();

        return $fractal->createData($personsData)->toArray();
    }

    /**
     * Add new employee function.
     *
     * @param Employee $employee Current employee
     * @param mixed    $formData Array of form data
     *
     * @return void
     */
    public function addFunction(Employee $employee, mixed $formData): void
    {
        $function = new EmployeeFunction();
        $function->setEmployee($employee);
        $employee->addFunction($function);
        $function->setFunctionName($formData['function_name']);
        $function->setStartedAt($formData['started_at']);
        if ($formData['ended_at']) {
            $function->setEndedAt($formData['ended_at']);
        }
        $function->setStatus($formData['status']);
        $function->setEdsEntity($this->em->getRepository(EdsEntity::class)->find($formData['eds_entity']));
        $this->em->persist($function);
        $this->em->flush();
    }

    /**
     * Add new formation.
     *
     * @param Employee $employee Current employee
     * @param mixed    $formData Array of form data
     *
     * @return void
     */
    public function addFormation(Employee $employee, mixed $formData): void
    {
        $formation = new Formation();
        $formation->setEmployee($employee);
        $employee->addFormation($formation);
        $formation->setName($formData['name']);
        $formation->setStartedAt($formData['started_at']);

        if ($formData['ended_at']) {
            $formation->setEndedAt($formData['ended_at']);
        }
        if ($formData['class_name']) {
            $formation->setClassName($this->em->getRepository(ClassName::class)->find($formData['class_name']));
        }
        if ($formData['result']) {
            $formation->setResult($formData['result']);
        }
        if ($formData['speciality']) {
            $formation->setResult($formData['speciality']);
        }
        if ($formData['suggested_direction']) {
            $formation->setResult($formData['suggested_direction']);
        }
        if ($formData['training_institution']) {
            $formation->setClassName($this->em->getRepository(TrainingInstitution::class)->find($formData['training_institution']));
        }

        $this->em->persist($formation);
        $this->em->flush();
    }
}