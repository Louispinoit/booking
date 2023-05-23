<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: 'loans')]
    private Collection $id_book;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_end = null;

    public function __construct()
    {
        $this->id_book = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, book>
     */
    public function getIdBook(): Collection
    {
        return $this->id_book;
    }

    public function addIdBook(book $idBook): self
    {
        if (!$this->id_book->contains($idBook)) {
            $this->id_book->add($idBook);
        }

        return $this;
    }

    public function removeIdBook(book $idBook): self
    {
        $this->id_book->removeElement($idBook);

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }
}
