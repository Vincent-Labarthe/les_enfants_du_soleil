<?php

namespace App\Repository;

use App\Entity\GeneralIdentifier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeneralIdentifier>
 *
 * @method GeneralIdentifier|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralIdentifier|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralIdentifier[]    findAll()
 * @method GeneralIdentifier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralIdentifierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralIdentifier::class);
    }

    public function add(GeneralIdentifier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GeneralIdentifier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GeneralIdentifier[] Returns an array of GeneralIdentifier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GeneralIdentifier
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
