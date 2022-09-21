<?php

namespace App\Service;

use App\Entity\EdsEntity;
use Doctrine\ORM\EntityManagerInterface;

class EdsEntityService
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function getParentEdsEntity()
    {
        return $this->em->getRepository(EdsEntity::class)->getParentEdsEntity();
    }
}