<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Beneficiary;
use App\Entity\BeneficiaryEdsEntity;
use App\Entity\EventMedicalType;
use App\Entity\Formation;
use App\Entity\GeneralIdentifier;
use App\Entity\HealthEvent;
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

    /**
     * Add address to beneficiary if not in Eds Entity.
     *
     * @param Beneficiary $beneficiary Current beneficiary
     * @param Address     $newAddress New address
     *
     * @return void
     */
    public function addAddress(Beneficiary $beneficiary, Address $newAddress): void
    {
        $beneficiary->setAddress($newAddress);
        $this->em->persist($newAddress);
        $this->em->flush();
    }

    /**
     * Add formation to beneficiary.
     *
     * @param Beneficiary $beneficiary Current beneficiary
     * @param mixed       $formData   Form data
     *
     * @return void
     */
    public function addFormation(Beneficiary $beneficiary, mixed $formData): void
    {
        $newFormation = new Formation();
        $newFormation->addStudent($beneficiary);
        $newFormation->setName($formData['name']);
        $newFormation->setSpecialty($formData['specialty']);
        $newFormation->setResult($formData['result']);
        $newFormation->setSuggestedDirection($formData['suggestedDirection']);
        $newFormation->setClassName($formData['className']);
        $newFormation->setStartedAt($formData['startedAt']);
        $this->em->persist($newFormation);
        $this->em->flush();
    }

    /**
     * Add localisation to beneficiary.
     *
     * @param Beneficiary $beneficiary Current beneficiary
     * @param mixed       $formData  Form data
     *
     * @return void
     */
    public function addLocalisation(Beneficiary $beneficiary, mixed $formData): void
    {
        if ($edsEntities = $beneficiary->getEdsEntity()) {
            foreach ($edsEntities as $edsEntity) {
                if ($edsEntity->getEndedAt() === null) {
                    $edsEntity->setEndedAt($formData['supportEndedAt'] ?? null);
                }
            }
        }
        $beneficiaryEdsEntity = new BeneficiaryEdsEntity();
        $beneficiaryEdsEntity->setBeneficiary($beneficiary);
        $beneficiaryEdsEntity->setEdsEntity($formData['edsEntity']);
        $beneficiaryEdsEntity->setStartedAt($formData['supportStartedAt']);
        $this->em->persist($beneficiaryEdsEntity);
        $this->em->flush();
    }

    /**
     * Add health event to beneficiary.
     *
     * @param Beneficiary $beneficiary Current beneficiary
     * @param mixed       $formData  Form data
     *
     * @return void
     */
    public function addHealthEvent(Beneficiary $beneficiary, mixed $formData): void
    {
        $healthEvent = new HealthEvent();
        $healthEvent->setEventDate($formData['date']);
        $healthEvent->setBeneficiary($beneficiary);
        $healthEvent->setIsDisease($formData['isDisease'] ?? false);
        $healthEvent->setReason($formData['reason'] ?? 'RAS');
        $healthEvent->setDiagnosis($formData['diagnosis']);
        $healthEvent->setAnalysis($formData['analysis']);
        $healthEvent->setComment($formData['comment']);
        $healthEvent->setConsultationCost($formData['consultationCost']);
        $healthEvent->setDrugsCost($formData['drugsCost']);
        $healthEvent->setEventMedicalType($this->em->getRepository(EventMedicalType::class)->find($formData['eventMedicalType']));
        $healthEvent->setImagery($formData['imagery']);
        $healthEvent->setOtherCost($formData['otherCost']);
        $healthEvent->setTreatment($formData['treatment']);

        $this->em->persist($healthEvent);
        $this->em->flush();
    }
}
