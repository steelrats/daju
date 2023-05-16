<?php

namespace App\Controller;

use App\Entity\Drones;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DroneController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/drone/{id}', name: 'app_drone')]
    public function index(String $id): Response
    {
        /**
         * @var DronesRepository
         */
        $drone = $this->em->getRepository(Drones::class);
        $drone = $drone->findOneBy(['id' => $id]);
        return $this->render('drone/index.html.twig', [
            'controller_name' => 'DroneController',
            'drone' => $drone
        ]);
    }
}
