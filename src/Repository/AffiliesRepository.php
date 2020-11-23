<?php

namespace App\Repository;

use App\Entity\Affilies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Affilies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Affilies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Affilies[]    findAll()
 * @method Affilies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AffiliesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Affilies::class);
    }

    // /**
    //  * @return Affilies[] Returns an array of Affilies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Affilies
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
