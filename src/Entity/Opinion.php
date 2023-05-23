<?php

namespace App\Entity;

use App\Repository\OpinionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpinionRepository::class)]
class Opinion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'opinions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'opinions')]
    private ?book $book = null;

    #[ORM\Column]
    private ?int $notation = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_publish = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?user
    {
        return $this->user;
    }

    public function setIdUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getIdBook(): ?book
    {
        return $this->book;
    }

    public function setIdBook(?book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getNotation(): ?int
    {
        return $this->notation;
    }

    public function setNotation(int $notation): self
    {
        $this->notation = $notation;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDatePublish(): ?\DateTimeInterface
    {
        return $this->date_publish;
    }

    public function setDatePublish(\DateTimeInterface $date_publish): self
    {
        $this->date_publish = $date_publish;

        return $this;
    }
}
