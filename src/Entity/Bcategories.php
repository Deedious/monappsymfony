<?php

namespace App\Entity;

use App\Repository\BcategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BcategoriesRepository::class)]
class Bcategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToMany(mappedBy: 'bcategory', targetEntity: Barticles::class)]
    private Collection $barticles;

    public function __construct()
    {
        $this->barticles = new ArrayCollection();
    }    

        public function __toString()
    {
        return $this->title;
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

    /**
     * @return Collection<int, Barticles>
     */
    public function getBarticles(): Collection
    {
        return $this->barticles;
    }

    public function addBarticle(Barticles $barticle): self
    {
        if (!$this->barticles->contains($barticle)) {
            $this->barticles->add($barticle);
            $barticle->setBcategory($this);
        }

        return $this;
    }

    public function removeBarticle(Barticles $barticle): self
    {
        if ($this->barticles->removeElement($barticle)) {
            // set the owning side to null (unless already changed)
            if ($barticle->getBcategory() === $this) {
                $barticle->setBcategory(null);
            }
        }

        return $this;
    }
}
