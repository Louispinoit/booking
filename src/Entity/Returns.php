<?php

namespace App\Entity;

use App\Repository\ReturnsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReturnsRepository::class)]
class Returns
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Loan $id_loan = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_return = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLoan(): ?Loan
    {
        return $this->id_loan;
    }

    public function setIdLoan(Loan $id_loan): self
    {
        $this->id_loan = $id_loan;

        return $this;
    }

    public function getDateReturn(): ?\DateTimeInterface
    {
        return $this->date_return;
    }

    public function setDateReturn(\DateTimeInterface $date_return): self
    {
        $this->date_return = $date_return;

        return $this;
    }
}
