<?php

namespace App\Repository;

use App\Entity\Filtres;
use App\Entity\Participant;
use App\Entity\Sortie;
use DateInterval;
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

public function ajouter1filtre(Filtres $pFiltres, Participant $pParticipant)
{

    $date = new DateTime('now');

    $queryBuilder = $this->createQueryBuilder('s');
    $queryBuilder->leftJoin('s.sortieParticipants','ps');


    if ($pSearch->getOrganisateur()){
        $organisateur = $pParticipant->getId();
        $queryBuilder->andWhere('s.organisateur = :organisateur')
            ->setParameter('organisateur',$organisateur);
    }
    if ($pSearch->getInscrit()){
        $participant = $pParticipant->getId();
        if($pSearch->getOrganisateur()||$pSearch->getNonInscrit()||$pSearch->getSortiePassee()){
            $queryBuilder->orWhere('ps.id = :participant');
        }else{
            $queryBuilder->andWhere('ps.id = :participant');
        }
        $queryBuilder->setParameter('participant',$participant);
    }
    if ($pSearch->getNonInscrit()){
        $participant = $pParticipant->getId();

        if($pSearch->getOrganisateur()||$pSearch->getInscrit()||$pSearch->getSortiePassee()){
            $queryBuilder->orWhere('ps.id != (:participant) OR ps.id is null');
        }else{
            $queryBuilder->andWhere('ps.id != (:participant) OR ps.id is null');
        }
        $queryBuilder->setParameter('participant',$participant);
    }



    if ($pSearch->getPassees()){
        if($pSearch->getOrganisateur()||$pSearch->getInscrit()||$pSearch->getNoInscrit()){
            $queryBuilder->orWhere('s.dateHeureDebut < :date');
        }else{
            $queryBuilder->andWhere('s.dateHeureDebut <:date');
        }
        $queryBuilder->setParameter('date',$date);
    }
    if($pSearch->getSite()!=null) {
        $site = $pSearch->getSite()->getId();
        $queryBuilder->andWhere('s.campus = :campus')
            ->setParameter('campus', $campus);
    }
    if ($pSearch->getRecherche() !=null ) {
        $search = $pSearch->getRecherche();
        $queryBuilder->andWhere('s.nom LIKE :search')
            ->setParameter('search', '%' . $search . '%');
    }
    if($pSearch->getDatedebut()!=null){
        $datedebut = $pSearch->getDatedebut();
        $queryBuilder->andWhere('s.datedebut >= :datedebut')
            ->setParameter('datedebut',$datedebut);
    }
    if($pSearch->getDatecloture()!=null){
        $datecloture = $pSearch->getDatecloture();
        $queryBuilder->andWhere('s.dateHeureDebut <= :datecloture')
            ->setParameter('datecloture',$datecloture);
    }
    $queryBuilder->andWhere('s.dateHeureDebut >:date');
    $dateM = $date;
    $dateM->sub(new DateInterval('P1M'));
    $queryBuilder->setParameter('date',$dateM);

    $query = $queryBuilder->getQuery();
    return $query->getResult();
}
}
