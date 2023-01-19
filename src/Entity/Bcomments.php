<?php

namespace App\Entity;

use App\Repository\BcommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BcommentsRepository::class)]
class Bcomments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bcomments')]
    private ?Barticles $barticle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarticle(): ?Barticles
    {
        return $this->barticle;
    }

    public function setBarticle(?Barticles $barticle): self
    {
        $this->barticle = $barticle;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }


}
