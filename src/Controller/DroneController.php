<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Drones;
use App\Entity\User;
use App\Form\CommentaireType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isNull;

class DroneController extends AbstractController
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/drone/{slug}', name: 'app_drone')]
    public function index(String $slug, Request $request, Security $security): Response
    {
        /**
         * @var DronesRepository
         */
        $drone = $this->em->getRepository(Drones::class);
        /**
         * @var Drones
         */
        $drone = $drone->findOneBy(['slug' => $slug]);
        if (is_null($drone)) {
            return $this->render('drone/error.html.twig');
        }

        $commentList = $drone->getCommentaire();

        $comment = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $comment);
        $form->handleRequest($request);
        $user = $security->getUser();
        if ($form->isSubmitted() && $form->isValid() && !is_null($user)) {
            $comment->setAuteur($user)
                ->setDrones($drone);

            $this->em->persist($comment);
            $this->em->flush();

            return $this->redirectToRoute('app_drone', ['slug' => $drone->getSlug()]);
        }

        return $this->render('drone/index.html.twig', [
            'drone' => $drone,
            'comment_form' => $form,
            'comment_list' => $commentList,
            'connected' => !is_null($user),
        ]);
    }
}
