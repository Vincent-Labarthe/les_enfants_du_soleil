<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Beneficiary;
use App\Entity\GeneralIdentifier;
use App\Transformer\Beneficiary\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class BeneficiaryService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
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

    /**
     * Add new beneficiary.
     *
     * @param array $formData array of form data
     *
     * @return Beneficiary
     */
    public function addBeneficiary(array $formData): Beneficiary
    {
        $beneficiary = new Beneficiary();
        $generalIdentifier = new GeneralIdentifier();
        $generalIdentifier->setFirstname($formData['firstName']);
        $generalIdentifier->setLastname($formData['lastName']);
        $generalIdentifier->setEmail($formData['email']);
        $generalIdentifier->setBeneficiary($beneficiary);
        $beneficiary->setDateOfBirth($formData['dateOfBirth']);
        $beneficiary->setOrigin($formData['status']);
        $beneficiary->setSexe($formData['sexe']);
        if (isset($formData['edsEntity'])) {
            $beneficiary->setEdsEntity($formData['edsEntity']);
        }
        $this->em->persist($beneficiary);
        $this->em->persist($generalIdentifier);
        $this->em->flush();

        return $beneficiary;
    }

    /**
     * @param Beneficiary $beneficiary
     * @param Address     $newAddress
     *
     * @return void
     */
    public function addAddress(Beneficiary $beneficiary,Address $newAddress): void
    {
        $beneficiary->setAddress($newAddress);
        $this->em->persist($newAddress);
        $this->em->flush();
    }
}