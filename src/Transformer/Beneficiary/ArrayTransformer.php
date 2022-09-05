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
     * @return array
     * @throws Exception
     */
    public function transform(Beneficiary $beneficiary): array
    {
        $dataTemp = [
            'firstname' => $beneficiary->getGeneralIdentifier()->getFirstname(),
            'lastname' => $beneficiary->getGeneralIdentifier()->getLastname(),
            'email' => $beneficiary->getGeneralIdentifier()->getEmail(),
            'id' => $beneficiary->getId(),
            'dateOfBirth' => $beneficiary->getDateOfBirth()->format('d-m-Y'),
            'age' => $this->getAge($beneficiary),
            'origin' => $beneficiary->getOrigin()->getType(),
            'localisation' => $beneficiary->getEdsEntity() ? $beneficiary->getEdsEntity()->getName() : null,
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
     * @param Beneficiary $beneficiary
     *
     * @return int
     * @throws Exception
     */
    private function getAge(Beneficiary $beneficiary): int
    {
        $date = new DateTime($beneficiary->getDateOfBirth()->format('Y-m-d'));
        $now = new DateTime();

        return $now->diff($date)->y;
    }
}
