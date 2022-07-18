<?php

namespace App\Repository;

use App\Entity\BehaviorEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BehaviorEvent>
 *
 * @method BehaviorEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BehaviorEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BehaviorEvent[]    findAll()
 * @method BehaviorEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BehaviorEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BehaviorEvent::class);
    }

    public function add(BehaviorEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BehaviorEvent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BehaviorEvent[] Returns an array of BehaviorEvent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BehaviorEvent
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
