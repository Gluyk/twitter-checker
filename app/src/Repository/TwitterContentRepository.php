<?php

namespace App\Repository;

use App\Entity\TwitterContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TwitterContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TwitterContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TwitterContent[]    findAll()
 * @method TwitterContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwitterContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TwitterContent::class);
    }

    // /**
    //  * @return TwitterContent[] Returns an array of TwitterContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TwitterContent
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
