<?php

namespace App\Entity;

use App\Repository\FiltresRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiltresRepository::class)]
class Filtres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Choice(['Nantes', 'Rennes'])]
    #[ORM\Column(nullable: false)]
    private ?string $site;

    #[Assert\NotBlank("search")]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'Your first name must be at least {{ limit }} characters long',
        maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
    )]
    #[ORM\Column(length: 30, nullable: true)]
    private ?string $contient = null;
    //private ?string $nom_lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datedebut = null;

    #[Assert\GreaterThanOrEqual('datedebut')]
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datecloture = null;

    #[ORM\Column(nullable: true)]
    private ?bool $organisateur = null;


    #[ORM\Column(nullable: true)]
    private ?bool $inscrit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $nonInscrit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $sortiePassee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getSite(): ?int
    {
        return $this->site;
    }

    public function setSite(?int $site): void
    {
        $this->site = $site;
    }

    public function getContient(): ?string
    {
        return $this->contient;
    }

    public function setContient(?string $contient): void
    {
        $this->contient = $contient;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(?\DateTimeInterface $datedebut): void
    {
        $this->datedebut = $datedebut;
    }

    public function getDatecloture(): ?\DateTimeInterface
    {
        return $this->datecloture;
    }

    public function setDatecloture(?\DateTimeInterface $datecloture): void
    {
        $this->datecloture = $datecloture;
    }

    public function getOrganisateur(): ?bool
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?bool $organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    public function getInscrit(): ?bool
    {
        return $this->inscrit;
    }

    public function setInscrit(?bool $inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    public function getNonInscrit(): ?bool
    {
        return $this->nonInscrit;
    }

    public function setNonInscrit(?bool $nonInscrit): void
    {
        $this->nonInscrit = $nonInscrit;
    }

    public function getSortiePassee(): ?bool
    {
        return $this->sortiePassee;
    }

    public function setSortiePassee(?bool $sortiePassee): void
    {
        $this->sortiePassee = $sortiePassee;
    }

}
