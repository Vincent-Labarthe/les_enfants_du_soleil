<?php

namespace App\Transformer\Beneficiary;

use App\Entity\Beneficiary;
use League\Fractal\TransformerAbstract;

/**
 * Class DetailToArrayTransformer.
 */
class DetailToArrayTransformer extends TransformerAbstract
{
    /**
     * Operation de transformation.
     */
    public function transform(Beneficiary $beneficiary): array
    {
        return [
            'id' => $beneficiary->getId(),
            'firstname' => $beneficiary->getFirstname(),
            'lastname' => $beneficiary->getLastname(),
            'email' => $beneficiary->getEmail(),
            'tel' => $beneficiary->getTel(),
            'origin' => $beneficiary->getOrigin(),
            'birthdate' => $beneficiary->getDateOfBirth()?->format('Y-m-d'),
            'gender' => $beneficiary->getSexe(),
            'support_start' => $beneficiary->getSupportStartedAt()?->format('Y-m-d'),
            'support_end' => $beneficiary->getSupportEndedAt()?->format('Y-m-d'),
            'image_url' => $beneficiary->getImageUrl() ?? '-',
            'birth_certificate' => $beneficiary->getBirthCertificate() ?? '-',
            'refOrdonnance' => $beneficiary->getRefOrdonnance() ?? '-',
            'plannedCareer' => $beneficiary->getPlannedCareer() ?? '-',
            'school_level' => $beneficiary->getSchoolLevel(),
            'degree' => $beneficiary->getDegree(),
            'localisation' => $this->getCurrentLocalisation($beneficiary),
            'internRef' => $beneficiary->getInternRef() ?? '-',
        ];
    }

    private function getCurrentLocalisation(Beneficiary $beneficiary)
    {
        $edsEntity = $beneficiary->getEdsEntity();
        if (null === $edsEntity) {
            return null;
        }

        foreach ($edsEntity as $eds) {
            if (null === $eds->getEndedAt()) {
                return $eds->getEdsEntity()?->getName();
            }
        }
    }
}
