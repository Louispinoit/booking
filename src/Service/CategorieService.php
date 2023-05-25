<?php

namespace App\Service;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

class CategorieService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getCategorieById($id): ?Categorie
    {
        return $this->entityManager->getRepository(Categorie::class)->find($id);
    }

    public function getBooksByCategorie(Categorie $categorie)
    {
        return $categorie->getBooks();
    }
}
