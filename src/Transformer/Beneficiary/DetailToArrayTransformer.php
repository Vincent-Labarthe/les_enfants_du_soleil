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
            'origin' => $beneficiary->getOrigin(),
            'birthdate' => $beneficiary->getDateOfBirth()?->format('Y-m-d'),
            'gender' => $beneficiary->getSexe(),
            'support_start' => $beneficiary->getSupportStartedAt()?->format('Y-m-d'),
            'image_url' => $beneficiary->getImageUrl(),
            'school_level' => $beneficiary->getSchoolLevel(),
            'degree' => $beneficiary->getDegree(),
            'localisation' => $beneficiary->getEdsEntity()?->getName(),
        ];
    }
}
