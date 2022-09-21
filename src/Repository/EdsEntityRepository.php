<?php

namespace App\Repository;

use App\Entity\EdsEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EdsEntity>
 *
 * @method EdsEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EdsEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EdsEntity[]    findAll()
 * @method EdsEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EdsEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EdsEntity::class);
    }

    public function add(EdsEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EdsEntity $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Get parent EdsEntity.
     *
     * @return float|int|mixed|string
     */
    public function getParentEdsEntity(): mixed
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.edsParent IS NULL or e.edsType = 2')
            ->getQuery()
            ->getResult();
    }
}
