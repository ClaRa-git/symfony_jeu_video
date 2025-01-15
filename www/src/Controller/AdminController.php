<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Note;
use App\Form\GameType;
use App\Repository\GameRepository;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin')]
class AdminController extends AbstractController
{
    /**
     * Méthode qui renvoie la page d'accueil de l'administration
     * @Route("/dashbord", name="app_admin_dashboard")
     * @return Response
     */
    #[Route('/dashbord', name: 'app_admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }
}
