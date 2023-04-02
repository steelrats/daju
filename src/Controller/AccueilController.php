<?php

namespace App\Controller;

use App\Entity\Drones;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(EntityManagerInterface $em): Response
    {
        $drones = $em->getRepository(Drones::class)->findAll();

            return $this->render('accueil/index.html.twig', [
                'controller_name' => 'AccueilController',
                'drones' => $drones
            ]);
        
    }
}
