<?php

namespace App\Transformer\Employee;

use App\Entity\Employee;
use League\Fractal\TransformerAbstract;

/**
 * Class DetailToArrayTransformer.
 */
class DetailToArrayTransformer extends TransformerAbstract
{
    /**
     * Operation de transformation.
     */
    public function transform(Employee $employee): array
    {
        return [
            'id' => $employee->getId(),
            'general_id' => $employee->getGeneralIdentifier()?->getId(),
            'firstname' => $employee->getFirstName(),
            'lastname' => $employee->getLastName(),
            'email' => $employee->getEmail(),
            'image_url' => $employee->getImageUrl() ?? '-',
            'status' => $employee->getStatus(),
            'tel' => $employee->getTel(),
            'birthday' => $employee->getBirthdate(),
            'gender' => $employee->getGender(),
            'start_date' => $employee->getStartedAt(),
            'end_date' => $employee->getEndedAt(),

        ];
    }
}
