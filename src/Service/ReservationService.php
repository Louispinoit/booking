<?php


namespace App\Service;

use App\Entity\Book;
use App\Entity\Loan;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createReservation($bookId, $startDate, $endDate, $user)
    {
        $book = $this->entityManager->getRepository(Book::class)->find($bookId);

        $reservation = new Loan();
        $reservation->addIdBook($book);
        $reservation->setDateStart(new DateTime($startDate));
        $reservation->setDateEnd(new DateTime($endDate));
        $reservation->setLoanBack(false);
        $reservation->setUser($user);

        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        return $reservation;
    }
}