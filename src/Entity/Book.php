<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $author = null;

    #[ORM\Column]
    private ?int $isbn = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $publicate_date = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: Loan::class, mappedBy: 'id_book')]
    private Collection $loans;

    #[ORM\OneToMany(mappedBy: 'id_book', targetEntity: Opinion::class)]
    private Collection $opinions;

    public function __construct()
    {
        $this->loans = new ArrayCollection();
        $this->opinions = new ArrayCollection();
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

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsbn(): ?int
    {
        return $this->isbn;
    }

    public function setIsbn(int $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getPublicateDate(): ?\DateTimeInterface
    {
        return $this->publicate_date;
    }

    public function setPublicateDate(\DateTimeInterface $publicate_date): self
    {
        $this->publicate_date = $publicate_date;

        return $this;
    }

    public function getIdCategorie(): ?categorie
    {
        return $this->categorie;
    }

    public function setIdCategorie(?categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Loan>
     */
    public function getLoans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): self
    {
        if (!$this->loans->contains($loan)) {
            $this->loans->add($loan);
            $loan->addIdBook($this);
        }

        return $this;
    }

    public function removeLoan(Loan $loan): self
    {
        if ($this->loans->removeElement($loan)) {
            $loan->removeIdBook($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Opinion>
     */
    public function getOpinions(): Collection
    {
        return $this->opinions;
    }

    public function addOpinion(Opinion $opinion): self
    {
        if (!$this->opinions->contains($opinion)) {
            $this->opinions->add($opinion);
            $opinion->setIdBook($this);
        }

        return $this;
    }

    public function removeOpinion(Opinion $opinion): self
    {
        if ($this->opinions->removeElement($opinion)) {
            // set the owning side to null (unless already changed)
            if ($opinion->getIdBook() === $this) {
                $opinion->setIdBook(null);
            }
        }

        return $this;
    }
}
