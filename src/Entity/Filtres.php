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

    #[ORM\Column(nullable: true)]
    private ?int $site_id = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $nom_lieu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $datecloture = null;

    #[ORM\Column(nullable: true)]
    private ?int $inscription_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSite_id(): ?int
    {
        return $this->site_id;
    }

    public function setSite_id(int $site_id): static
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getNom_lieu(): ?string
    {
        return $this->nom_lieu;
    }

    public function setNom_lieu(string $nom_lieu): static
    {
        $this->nom_lieu = $nom_lieu;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatecloture(): ?\DateTimeInterface
    {
        return $this->datecloture;
    }

    public function setDatecloture(?\DateTimeInterface $datecloture): static
    {
        $this->datecloture = $datecloture;

        return $this;
    }

    public function getInscription_id(): ?int
    {
        return $this->inscription_id;
    }

    public function setInscription_id(?int $inscription_id): static
    {
        $this->inscription_id = $inscription_id;

        return $this;
    }
}
