<?php

namespace App\Repository;

use App\Entity\EventBehaviorType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventBehaviorType>
 *
 * @method EventBehaviorType|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventBehaviorType|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventBehaviorType[]    findAll()
 * @method EventBehaviorType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventBehaviorTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventBehaviorType::class);
    }

    public function add(EventBehaviorType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EventBehaviorType $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EventBehaviorType[] Returns an array of EventBehaviorType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EventBehaviorType
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
