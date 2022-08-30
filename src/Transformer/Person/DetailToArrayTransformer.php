<?php

namespace App\Transformer\Person;

use App\Entity\Person;
use League\Fractal\TransformerAbstract;

/**
 * Class DetailToArrayTransformer.
 */
class DetailToArrayTransformer extends TransformerAbstract
{
    /**
     * Operation de transformation
     *
     * @param Person $person
     *
     * @return array
     */
    public function transform(Person $person): array
    {
        return [
            'id' => $person->getId(),
            'firstname' => $person->getFirstname(),
            'lastname' => $person->getLastname(),
            'origin' => $person->getOrigin(),
            'email' => $person->getEmail(),
            'birthdate'=> $person->getDateOfBirth()->format('Y-m-d'),
            'gender' => $person->getSexe(),
            'support_start' =>$person->getSupportStartedAt() ? $person->getSupportStartedAt()->format('Y-m-d') : null,
            'image_url' => $person->getImageUrl(),
            'school_level' => $person->getSchoolLevel(),
            'degree' => $person->getDegree(),
            'localisation' => $person->getEdsEntity()->getName(),
        ];
    }
}
