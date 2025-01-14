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

        // Récupération des consoles du jeu
        $consoles = $gameRepository->getConsolesByGame($id);

        return $this->render('home/detail.html.twig', [
            'title' => $title,
            'game' => $game,
            'consoles' => $consoles
        ]);
    }

    /**
     * Méthode permettant d'afficher la liste des jeux par console
     * @Route("/console/{id}", name="app_console")
     * @param GameRepository $gameRepository
     * @param int $id
     * @return Response
     */
    #[Route('/console/{id}', name: 'app_console')]
    public function gamesByConsole(GameRepository $gameRepository, int $id): Response
    {
        // Récupération des datas des jeux par console
        $games = $gameRepository->getGamesByConsole($id);

        // Récupération du nom de la console
        $title = 'Tous les jeux : ' . $games[0]['label'];

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'games' => $games
        ]);
    }

    /**
     * Méthode permettant d'afficher la liste des jeux par âge
     * @Route("/age/{id}", name="app_age")
     * @param GameRepository $gameRepository
     * @param int $id
     * @return Response
     */
    #[Route('/age/{id}', name: 'app_age')]
    public function gamesByAge(GameRepository $gameRepository, int $id): Response
    {
        // Récupération des datas des jeux par âge
        $games = $gameRepository->getGamesByAge($id);

        // Récupération du nom de l'âge
        $title = 'Tous les jeux : ' . $games[0]['label'] . '+';

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'games' => $games
        ]);
    }

    /**
     * Méthode permettant d'afficher la liste des jeux par filtre
     * @Route("/gems/filter/{field}", name="app_filter")
     * @param GameRepository $gameRepository
     * @param string $field
     * @return Response
     */
    #[Route('/games/filter/{field}', name: 'app_filter')]
    public function gamesByFilter(GameRepository $gameRepository, string $field): Response
    {
        // Récupération des datas des jeux par filtre
        $games = $gameRepository->getGamesByFilter($field);

        return $this->render('home/index.html.twig', [
            'title' => 'Tous les jeux',
            'games' => $games
        ]);
    }
}
