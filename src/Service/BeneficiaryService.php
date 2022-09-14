<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Beneficiary;
use App\Entity\BeneficiaryEdsEntity;
use App\Entity\GeneralIdentifier;
use App\Transformer\Beneficiary\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class BeneficiaryService
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function getSupportedPerson(): ?array
    {
        $personCollection = $this->em->getRepository(Beneficiary::class)->getSupportedPerson();
        $personsData = new Collection($personCollection, new ArrayTransformer());
        $fractal = new Manager();

        return $fractal->createData($personsData)->toArray();
    }

    /**
     * Add new beneficiary.
     *
     * @param array $formData array of form data
     */
    public function addBeneficiary(array $formData): Beneficiary
    {
        $generalIdentifier = new GeneralIdentifier();
        $beneficiary = new Beneficiary();
        $generalIdentifier->setBeneficiary($beneficiary);
        $beneficiary->setFirstName($formData['firstName']);
        $beneficiary->setLastName($formData['lastName']);
        $beneficiary->setEmail($formData['email']);
        $beneficiary->setDateOfBirth($formData['dateOfBirth']);
        $beneficiary->setOrigin($formData['origin']);
        $beneficiary->setSexe($formData['sexe']);
        $beneficiaryEdsEntity = new BeneficiaryEdsEntity();
        $beneficiaryEdsEntity->setBeneficiary($beneficiary);
        $beneficiaryEdsEntity->setEdsEntity($formData['edsEntity']);
        $beneficiaryEdsEntity->setStartedAt($formData['supportStartedAt']);

        $this->em->persist($beneficiaryEdsEntity);
        $this->em->persist($beneficiary);
        $this->em->persist($generalIdentifier);
        $this->em->flush();

        return $beneficiary;
    }

    public function addAddress(Beneficiary $beneficiary, Address $newAddress): void
    {
        $beneficiary->setAddress($newAddress);
        $this->em->persist($newAddress);
        $this->em->flush();
    }

    public function editBeneficiary(Beneficiary $beneficiary, mixed $formData)
    {
    }
}
