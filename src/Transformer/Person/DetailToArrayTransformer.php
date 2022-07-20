<?php

namespace App\Transformer\Person;

use App\Entity\Person;
use League\Fractal\TransformerAbstract;

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
            'email' => $person->getEmail(),
            'birthdate'=> $person->getDateOfBirth()->format('Y-m-d'),
            'gender' => $person->getSexe(),
            'support_start' => $person->getSupportStartedAt()->format('Y-m-d'),
        ];
    }
}