<?php

namespace App\Repository;

use App\Entity\Filtres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Filtres>
 */
class FiltresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Filtres::class);
    }

    public function findBySite(PropertySearch $pSearch)
    {
        $search = $pSearch->getRecherche();
        $queryBuilder = $this->createQueryBuilder('p')
            ->where('p.nom LIKE :search')
            ->setParameter('search','%'.$search.'%')->getQuery();
        return $queryBuilder->getResult();
    }
    //    /**
    //     * @return Filtres[] Returns an array of Filtres objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Filtres
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
