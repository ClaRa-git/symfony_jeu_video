<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    /**
     * Méthode permettant d'afficher la page d'accueil avec la liste de tous les jeux
     * @Route("/", name="app_home")
     * @param GameRepository $gameRepository
     * @return Response
     */
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

    /** Méthode permettant d'afficher les détails d'un jeu avec toutes ses informations
     * @Route("/detail/{id}", name="app_detail")
     * @param GameRepository $gameRepository
     * @param int $id
     * @return Response  
     */
    #[Route('/detail/{id}', name: 'app_detail')]
    public function detail(GameRepository $gameRepository, int $id): Response
    {
        // Titre de la page
        $title = "Détails du jeu";

        // Récupération des datas d'un jeu
        $game = $gameRepository->getGameWithInfos($id);

        return $this->render('home/detail.html.twig', [
            'title' => $title,
            'game' => $game
        ]);
    }
}
