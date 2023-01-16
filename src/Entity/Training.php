<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingRepository::class)]
class Training
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $articleblog = null;

    #[ORM\Column(length: 255)]
    private ?string $videos = null;

    #[ORM\Column(length: 255)]
    private ?string $chat = null;

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

    public function getArticleblog(): ?string
    {
        return $this->articleblog;
    }

    public function setArticleblog(string $articleblog): self
    {
        $this->articleblog = $articleblog;

        return $this;
    }

    public function getVideos(): ?string
    {
        return $this->videos;
    }

    public function setVideos(string $videos): self
    {
        $this->videos = $videos;

        return $this;
    }

    public function getChat(): ?string
    {
        return $this->chat;
    }

    public function setChat(string $chat): self
    {
        $this->chat = $chat;

        return $this;
    }
}
