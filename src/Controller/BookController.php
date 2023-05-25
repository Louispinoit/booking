<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Opinion;
use App\Form\OpinionFormType;
use App\Service\OpinionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private $opinionService;

    public function __construct(OpinionService $opinionService)
    {
        $this->opinionService = $opinionService;
    }

    #[Route('/book/{id}/reviews', name: 'book_reviews')]
    public function reviews($id, Request $request, EntityManagerInterface $em)
    {
        $book = $em->getRepository(Book::class)->find($id);
        $form = $this->createForm(OpinionFormType::class)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->opinionService->addOpinion($book, $form, $this->getUser());
            return $this->redirectToRoute('book_reviews', ['id' => $id]);
        }

        return $this->render('book/index.html.twig', [
            'bookId' => $id,
            'reviews' => $this->opinionService->getOpinionsByBook($id),
            'OpinionForm' => $form->createView()
        ]);
    }
}