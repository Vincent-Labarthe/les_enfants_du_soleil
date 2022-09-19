<?php

namespace App\Transformer\Beneficiary;

use App\Entity\Beneficiary;
use DateTime;
use Exception;
use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{
    /**
     * Transform a Beneficiary entity to an array.
     *
     * @param Beneficiary $beneficiary The person entity
     *
     * @throws Exception
     */
    public function transform(Beneficiary $beneficiary): array
    {
        $dataTemp = [
            'firstname' => $beneficiary->getFirstname(),
            'lastname' => $beneficiary->getLastname(),
            'email' => $beneficiary->getEmail(),
            'id' => $beneficiary->getId(),
            'dateOfBirth' => $beneficiary->getDateOfBirth()?->format('d-m-Y'),
            'age' => $this->getAge($beneficiary),
            'origin' => $beneficiary->getOrigin()?->getType(),
            'localisation' => $this->getCurrentLocalisation($beneficiary),
        ];

        $data = [];
        foreach ($dataTemp as $key => $val) {
            $data[$key] = ($val ?? '');
        }

        return $data;
    }

    /**
     * Get age from birthdate.
     *
     * @throws Exception
     */
    private function getAge(Beneficiary $beneficiary): int
    {
        $date = new DateTime($beneficiary->getDateOfBirth()?->format('Y-m-d'));
        $now = new DateTime();

        return $now->diff($date)->y;
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
