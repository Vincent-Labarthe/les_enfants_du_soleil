<?php

namespace App\Repository;

use App\Entity\Beneficiary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beneficiary>
 *
 * @method Beneficiary|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beneficiary|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beneficiary[]    findAll()
 * @method Beneficiary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficiaryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beneficiary::class);
    }

    public function add(Beneficiary $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Beneficiary $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getSupportedPerson()
    {
        return $this->createQueryBuilder('p')
            ->where('p.supportEndedAt IS NULL')
            ->getQuery()
            ->getResult();
    }

    public function search($formData)
    {
        $query = $this->createQueryBuilder('b')->where('b.firstName LIKE :firstName')->setParameter(
            'firstName',
            '%'.$formData['firstName'].'%'
        )->andWhere('b.lastName LIKE :lastName')->setParameter('lastName', '%'.$formData['lastName'].'%')->andWhere(
            'b.sexe LIKE :sexe'
        )->setParameter('sexe', '%'.$formData['sexe'].'%');

        if (isset($formData['dateOfBirth'])) {
            $query->andWhere('b.dateOfBirth LIKE :birthDate')->setParameter('birthDate', '%'.$formData['dateOfBirth']->format('Y-m-d').'%');
        }

        if (isset($formData['edsEntity'])) {
            $query->join('b.edsEntity', 'e')->andWhere('e.id = :edsEntity')->setParameter('edsEntity', $formData['edsEntity']->getId());
        }

        if (isset($formData['origin'])) {
            $query->join('b.origin', 'o')->andWhere('o.id = :origin')->setParameter('origin', $formData['origin']->getId());
        }

        return $query->getQuery()->getResult();
    }
}
