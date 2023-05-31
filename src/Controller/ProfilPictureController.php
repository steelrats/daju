<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilPictureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilPictureController extends AbstractController
{
    #[Route('/profil/picture', name: 'app_profil_picture')]
    public function index(EntityManagerInterface $em, Security $security, Request $request): Response
    {
        $form = $this->createForm(ProfilPictureType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var User
             */
            $user = $security->getUser();

            /**
             * @var UploadedFile
             * */
            $pp = $form->get('pp')->getData();

            $newFilename = $user->getId() . '.png';

            // Move the file to the directory where brochures are stored
            try {
                $destination = $this->getParameter('kernel.project_dir') . '/public/img/uploads/pp/';
                $pp->move(
                    $destination,
                    $newFilename
                );
            } catch (FileException $e) {
                dd($e);
            }

            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('profil_picture/index.html.twig', [
            'controller_name' => 'ProfilPictureController',
            'pp_form' => $form->createView(),
        ]);
    }
}
