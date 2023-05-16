<?php

namespace App\Controller;

use App\Entity\Camera;
use App\Entity\Drones;
use App\Entity\Fabriquant;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/data')]
class DataController extends AbstractController
{
    #[Route('/', name: 'app_data')]
    public function index(): Response
    {
        return $this->render('data/index.html.twig', [
            'controller_name' => 'DataController',
        ]);
    }

    #[Route('/add', name: 'app_data_add')]
    public function addData(EntityManagerInterface $em)
    {
        $now = new DateTimeImmutable("now");

        $dji = new Fabriquant();
        $dji->setNom("DJI")
            ->setcreatedAt($now);
        $em->persist($dji);

        $fimi = new Fabriquant();
        $fimi->setNom('FIMI')
            ->setcreatedAt($now);
        $em->persist($fimi);

        $camera1 = new Camera();
        $camera1->setCreatedAt($now)
            ->setFov(83)
            ->setOuverture(2.8)
            ->setResolutionHorizontal(3840)
            ->setResolutionVertical(2160)
            ->setStabilise(true);
        $em->persist($camera1);

        $camera2 = new Camera();
        $camera2->setCreatedAt($now)
            ->setFov(80)
            ->setOuverture(2)
            ->setResolutionHorizontal(3840)
            ->setResolutionVertical(2160)
            ->setStabilise(true);
        $em->persist($camera2);

        $camera3 = new Camera();
        $camera3->setCreatedAt($now)
            ->setFov(84)
            ->setOuverture(2.8)
            ->setResolutionHorizontal(3840)
            ->setResolutionVertical(2160)
            ->setStabilise(true);
        $em->persist($camera3);

        $camera4 = new Camera();
        $camera4->setCreatedAt($now)
            ->setFov(88)
            ->setOuverture(2.8)
            ->setResolutionHorizontal(5472)
            ->setResolutionVertical(3078)
            ->setStabilise(true);
        $em->persist($camera4);

        $mini2 = new Drones();
        $mini2->setCreatedAt($now)
            ->setCamera($camera1)
            ->setFabriquant($dji)
            ->setImageName('1680028685_61d2faa892b57c0004c6474a.png')
            ->setNom('Mini 2')
            ->setPoids(249)
            ->setPrix(459)
            ->setResistanceVent(5)
            ->setVitesseHorizon(16)
            ->setVitesseVerticale(5);
        $em->persist($mini2);

        $x8 = new Drones();
        $x8->setCreatedAt($now)
            ->setCamera($camera2)
            ->setFabriquant($fimi)
            ->setImageName('1680471922_x8-mini.png')
            ->setNom('X9 Mini')
            ->setPoids(249)
            ->setPrix(399)
            ->setResistanceVent(5)
            ->setVitesseHorizon(16)
            ->setVitesseVerticale(5);
        $em->persist($x8);

        $air2s = new Drones();
        $air2s->setCreatedAt($now)
            ->setCamera($camera3)
            ->setFabriquant($dji)
            ->setImageName('1680472106_0ac5dca56726b3dba012e25b5a3082eb.png')
            ->setNom('Air 2S')
            ->setPoids(595)
            ->setPrix(999)
            ->setResistanceVent(5)
            ->setVitesseHorizon(19)
            ->setVitesseVerticale(6);
        $em->persist($air2s);

        $phantom = new Drones();
        $phantom->setCreatedAt($now)
            ->setCamera($camera4)
            ->setFabriquant($dji)
            ->setImageName('1680472822_fb67993948b054f2563a2a4906ebdc3f-1x.webp')
            ->setNom('Phantom 4 pro V2.0')
            ->setPoids(1375)
            ->setPrix(1699)
            ->setResistanceVent(5)
            ->setVitesseHorizon(20)
            ->setVitesseVerticale(6);
        $em->persist($phantom);

        $em->flush();

        return $this->redirectToRoute('app_accueil');
    }
}
