<?php

namespace App\Transformer\Employee;

use App\Entity\Employee;
use League\Fractal\TransformerAbstract;

class ArrayTransformer extends TransformerAbstract
{
    /**
     * Transform an Employee entity to an array.
     *
     * @param Employee $employee The person entity
     */
    public function transform(Employee $employee): array
    {
        $dataTemp = [
            'firstname' => $employee->getFirstname(),
            'lastname' => $employee->getLastname(),
            'email' => $employee->getEmail(),
            'id' => $employee->getId(),
            'status' => $employee->getStatus(),
            'localisation' => $this->getEdsEntity($employee),
        ];

        $data = [];
        foreach ($dataTemp as $key => $val) {
            $data[$key] = ($val ?? '');
        }

        return $data;
    }

    private function getEdsEntity($employee)
    {
        $data = null;
        foreach ($employee->getEdsEntity() as $edsEntity) {
            $data .= $edsEntity->getName().' ';
        }

        return $data;
    }
}
