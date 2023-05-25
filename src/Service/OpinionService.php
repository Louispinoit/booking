<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\Opinion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

class OpinionService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addOpinion(Book $book, FormInterface $form, $user)
    {
        $opinion = new Opinion();
        $opinion->setIdBook($book);
        $opinion->setIdUser($user);
        $notation = $form->get('notation')->getData();
        $opinion->setNotation($notation);
        $comment = $form->get('comment')->getData();
        $opinion->setComment($comment);
        $opinion->setDatePublish(new \DateTime());

        $this->entityManager->persist($opinion);
        $this->entityManager->flush();
    }

    public function getOpinionsByBook($bookId)
    {
        $opinionRepository = $this->entityManager->getRepository(Opinion::class);
        return $opinionRepository->findBy(['book' => $bookId]);
    }
}
