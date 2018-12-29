<?php

namespace App\Repository;

use App\Entity\Searchoption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Searchoption|null find($id, $lockMode = null, $lockVersion = null)
 * @method Searchoption|null findOneBy(array $criteria, array $orderBy = null)
 * @method Searchoption[]    findAll()
 * @method Searchoption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SearchoptionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Searchoption::class);
    }

    // /**
    //  * @return Searchoption[] Returns an array of Searchoption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Searchoption
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
