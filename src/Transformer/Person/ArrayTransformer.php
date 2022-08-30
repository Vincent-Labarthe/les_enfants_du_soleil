<?php

namespace App\Transformer\Person;

use App\Entity\Person;
use DateTime;
use Exception;
use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{
    /**
     * Transform a person entity to an array.
     *
     * @param Person $person The person entity
     *
     * @return array
     * @throws Exception
     */
    public function transform(Person $person): array
    {
        $dataTemp = [
            'id' => $person->getId(),
            'firstname' => $person->getFirstname(),
            'lastname' => $person->getLastname(),
            'email' => $person->getEmail(),
            'dateOfBirth' => $person->getDateOfBirth()->format('d-m-Y'),
            'age' => $this->getAge($person),
            'origin' => $person->getOrigin()->getType(),
            'localisation' => $person->getEdsEntity()->getName(),
        ];

        $data = [];
        foreach ($dataTemp as $key => $val) {
            $data[$key] = ($val ?? '');
        }

        return $data;
    }

    /**
     * Get age from birthdate
     *
     * @param Person $person Person to get age
     *
     * @return int
     * @throws Exception
     */
    private function getAge(Person $person): int
    {
        $date = new DateTime($person->getDateOfBirth()->format('Y-m-d'));
        $now = new DateTime();

        return $now->diff($date)->y;
    }
}
