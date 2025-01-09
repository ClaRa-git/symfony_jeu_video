<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GameRepository $gameRepository): Response
    {
        // Déclaration d'une variable
        $title = "Tous les jeux";

        // Récupération les datas de tous les jeux
        $games = $gameRepository->findAll();



        return $this->render('home/index.html.twig', [
            'title' => $title,
            'games' => $games
        ]);
    }
}
