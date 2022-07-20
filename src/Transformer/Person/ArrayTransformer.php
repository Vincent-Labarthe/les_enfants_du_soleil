<?php

namespace App\Transformer\Person;

use App\Entity\Person;
use DateTime;
use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{
    /**
     * Opération de transformation
     *
     */
    public function transform(Person $person)
    {
        $dataTemp =  [
            'id' => $person->getId(),
            'firstname' => $person->getFirstname(),
            'lastname' => $person->getLastname(),
            'email' => $person->getEmail(),
            'age'=> $this->getAge($person),
        ];

        $data = [];
        foreach ($dataTemp as $key => $val) {
            $data[$key] = ($val ?? '');
        }

        return $data;
    }

    private function getAge(Person $person)
    {
        $date = new DateTime($person->getDateOfBirth()->format('Y-m-d'));
        $now = new DateTime();
        return $now->diff($date)->y;
    }
}