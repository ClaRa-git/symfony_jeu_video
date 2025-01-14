<?php

namespace App\Controller;

use App\Repository\GameRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'app_admin')]
    public function index(GameRepository $gameRepository): Response
    {
        // On récupère tous les jeux
        $games = $gameRepository->findAll();

        return $this->render('game/index.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * Méthode pour voir un jeu en détail dans l'admin
     * @Route("/detail/{id}", name="app_game_show")
     * @param GameRepository $gameRepository
     * @param $id
     * @return Response
     */
    #[Route("/detail/{id}", name: "app_game_show")]
    public function gameDetailDashboard(GameRepository $gameRepository, $id): Response
    {
        // Titre de la page
        $title = "Détails du jeu";

        // Récupération des datas d'un jeu
        $game = $gameRepository->getGameWithInfos($id);

        // Récupération des consoles du jeu
        $consoles = $gameRepository->getConsolesByGame($id);

        return $this->render('game/show.html.twig', [
            'title' => $title,
            'game' => $game,
            'consoles' => $consoles
        ]);
    }
}
