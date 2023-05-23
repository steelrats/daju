<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Drones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EntityManagerInterface $em, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $em->getRepository(Drones::class)->findAll();

        $drones = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('accueil/index.html.twig', [
                'drones' => $drones
            ]);
        
    }
}
