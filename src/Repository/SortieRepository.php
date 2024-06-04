<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }


public function findBySite()
{

        // version QueryBuilder
    $queryBuilder = $this->createQueryBuilder('s');
    $queryBuilder->andWhere('s.site = :site')
    ->setParameter('site', $site);

    return $qb->getQuery()->getResult();
    }


}
