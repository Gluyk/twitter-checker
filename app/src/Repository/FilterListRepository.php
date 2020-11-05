<?php

namespace App\Repository;

use App\Entity\FilterList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FilterList|null find($id, $lockMode = null, $lockVersion = null)
 * @method FilterList|null findOneBy(array $criteria, array $orderBy = null)
 * @method FilterList[]    findAll()
 * @method FilterList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilterListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilterList::class);
    }

    // /**
    //  * @return FilterList[] Returns an array of FilterList objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FilterList
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
