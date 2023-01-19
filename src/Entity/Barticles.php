<?php

namespace App\Entity;

use App\Repository\BarticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarticlesRepository::class)]
class Barticles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'barticles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bcategories $bcategory = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\OneToMany(mappedBy: 'barticle', targetEntity: Bcomments::class)]
    private Collection $bcomments;

    public function __construct()
    {
        $this->bcomments = new ArrayCollection();
    }
      
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBcategory(): ?Bcategories
    {
        return $this->bcategory;
    }

    public function setBcategory(?Bcategories $bcategory): self
    {
        $this->bcategory = $bcategory;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Bcomments>
     */
    public function getBcomments(): Collection
    {
        return $this->bcomments;
    }

    public function addBcomment(Bcomments $bcomment): self
    {
        if (!$this->bcomments->contains($bcomment)) {
            $this->bcomments->add($bcomment);
            $bcomment->setBarticle($this);
        }

        return $this;
    }

    public function removeBcomment(Bcomments $bcomment): self
    {
        if ($this->bcomments->removeElement($bcomment)) {
            // set the owning side to null (unless already changed)
            if ($bcomment->getBarticle() === $this) {
                $bcomment->setBarticle(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->bcategory;
    }
}
