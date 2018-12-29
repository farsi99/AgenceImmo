<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Property;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\PropertySearch;


/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * On crée une méthode qui nous retourne tous les biens non vendu
     * @return Query
     */

    public function findAllVisibleQuery(PropertySearch $search) : Query
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice()) {
            $query = $query->andwhere('p.price <= :maxprice'); //cette méthode permet de proteger les champs des injections
            $query->setParameter('maxprice', $search->getMaxPrice());
        }
        if ($search->getMinSurface()) {
            $query = $query->andwhere('p.surface >= :minsurface'); //cette méthode permet de proteger les champs des injections
            $query->setParameter('minsurface', $search->getMinSurface());
        }
        if ($search->getSearchoptions()->count() > 0) {
            $k = 0;
            foreach ($search->getSearchoptions() as $option) {
                $k++;
                $query = $query->andwhere(":option$k MEMBER OF p.searchoptions");
                $query->setParameter("option$k", $option);
            }
        }
        return $query->getQuery();
    }

    /**
     * On crée une méthode qui retourne les dernieres biens
     * @return Property[]
     */
    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }


    private function findVisibleQuery()
    {
        return $this->createQueryBuilder('p')
            ->Where('p.sold = false');
    }

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     */
}
