<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use App\Entity\Commentaire;
use App\Entity\Drones;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(DronesCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_accueil');
        yield MenuItem::linkToCrud('Drones', 'fa-regular fa-drone', Drones::class);
        yield MenuItem::linkToCrud('Commentaire', 'fa-regular fa-comment', Commentaire::class);
        yield MenuItem::linkToCrud('Camera', 'bi bi-camera', Camera::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa-regular fa-user', User::class);
    }
}
