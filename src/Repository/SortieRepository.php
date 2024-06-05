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

    /**
     * @param string $site
     * @return Sortie[]
     */

public function findBySite(string $site)
{
    $queryBuilder = $this->createQueryBuilder('s');
    $queryBuilder->where('s.site = :site')
    ->setParameter('site', $site);

    return $queryBuilder->getQuery()->getResult();
    }
}
