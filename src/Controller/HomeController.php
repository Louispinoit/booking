<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Categorie;
use App\Entity\Loan;
use App\Service\CategorieService;
use App\Service\ReservationService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }


    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {

        $categories = $em->getRepository(categorie::class)->findAll();

        $books = $em->getRepository(Book::class)->findAll();


        if ($this->getUser()) {

            $userId = $this->getUser()->getId();

            $dql = "SELECT l FROM App\Entity\Loan l WHERE l.user = :userId";
            $query = $em->createQuery($dql);
            $query->setParameter('userId', $userId);
            $loans = $query->getResult();



            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'firstname' => $this->getUser()->getFirstName(),
                'name' => $this->getUser()->getName(),
                'books' => $books,
                'categories' => $categories,
                'loans' => $loans,
            ]);
        }


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/categorie/{id}', name: 'categorie_show')]
    public function categorieShow($id, CategorieService $categorieService): Response
    {
        $categorie = $categorieService->getCategorieById($id);

        $today = new \DateTime();
        $today = $today->format('Y-m-d');

        if (!$categorie) {
            throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
        }

        $books = $categorieService->getBooksByCategorie($categorie);

        return $this->render('home/categorie_show.html.twig', [
            'categorie' => $categorie,
            'books' => $books,
            'todayDate' => $today,
        ]);
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function create(Request $request,  EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
        $bookId = $data['bookId'];
        $startDate = $data['startDate'];
        $endDate = $data['endDate'];

        $reservation = $this->reservationService->createReservation($bookId, $startDate, $endDate, $this->getUser());

        return new JsonResponse(['success' => true, 'reservationId' => $reservation->getId()]);
    }
}
