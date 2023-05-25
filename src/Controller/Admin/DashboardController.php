<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\Categorie;
use App\Entity\Loan;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        $url = $this->adminUrlGenerator
            ->setController(BookCrudController::class)
            ->generateUrl();

        return $this->redirect($url);


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Booking');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Utilisateurs ');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud("Ajouter un utilisateur", "fas fa-plus", User::class)->setAction("new"),
            MenuItem::linkToCrud("Voir les utilisateurs", "fas fa-eye", User::class),
            MenuItem::linkToCrud("Voir les emprunts", "fas fa-eye", Loan::class),


        ]);
        yield MenuItem::section('Livres ');

        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud("Ajouter un livre", "fas fa-plus", Book::class)->setAction("new"),
            MenuItem::linkToCrud("Voir les livres", "fas fa-eye", Book::class),
        ]);

        yield MenuItem::subMenu('Categorie', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud("Ajouter une catégorie", "fas fa-plus", Categorie::class)->setAction("new"),
            MenuItem::linkToCrud("Voir les catégorie", "fas fa-eye", Categorie::class),
        ]);



        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
