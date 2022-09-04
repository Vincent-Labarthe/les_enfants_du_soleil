<?php

namespace App\Service;

use App\Entity\Beneficiary;
use App\Entity\GeneralIdentifier;
use App\Transformer\Beneficiary\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class BeneficiaryService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @return array|null
     */
    public function getSupportedPerson(): ?array
    {
        $personCollection = $this->em->getRepository(Beneficiary::class)->getSupportedPerson();
        $personsData = new Collection($personCollection, new ArrayTransformer());
        $fractal = new Manager();

        return $fractal->createData($personsData)->toArray();
    }

    public function addBeneficiary($formData)
    {
        $beneficiary = new Beneficiary();
        $generalIdentifier = new GeneralIdentifier();
        $generalIdentifier->setFirstname($formData['firstname']);
        $generalIdentifier->setLastname($formData['lastname']);
        $generalIdentifier->setEmail($formData['email']);
        $beneficiary->setDateOfBirth($formData['dateOfBirth']);
        $beneficiary->setOrigin($formData['origin']);
        $beneficiary->setEdsEntity($formData['localisation']);
        $beneficiary->setGeneralIdentifier($formData['generalIdentifier']);

        $this->em->persist($beneficiary);
        $this->em->flush();
    }
}