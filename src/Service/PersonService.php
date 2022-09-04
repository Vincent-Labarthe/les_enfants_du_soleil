<?php

namespace App\Service;

use App\Entity\Beneficiary;
use App\Transformer\Beneficiary\ArrayTransformer;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class PersonService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @return array|null
     */
    public function getSupportedPerson(): ?array
    {
        $personCollection = $this->em->getRepository(Beneficiary::class)->getSupportedPerson();
        $personsData = new Collection($personCollection, new ArrayTransformer());
        $fractal = new Manager();

        return $fractal->createData($personsData)->toArray();
    }
}