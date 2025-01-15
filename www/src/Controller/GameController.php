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

#[Route('/admin/game')]
class GameController extends AbstractController
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

    /**
     * Méthode pour supprimer un jeu
     * @Route("/delete/{id}", name="app_game_delete")
     * @param GameRepository $gameRepository
     * @param Game $game
     * @param Request $request
     * @return Response
     */
    #[Route("/delete/{id}", name: "app_game_delete")]
    public function gameDelete(GameRepository $gameRepository, Game $game, Request $request): Response
    {
        // On vérifie si le token est valide
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) 
        {
            // On supprime le jeu
            $gameRepository->delete($game, true);
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Méthode pour créer un jeu
     * @Route("/new", name="app_game_new")
     * @param GameRepository $gameRepository
     * @param NoteRepository $noteRepository
     * @param Request $request
     * @return Response
     */
    #[Route("/new", name: "app_game_new", methods: ['GET', 'POST'])]
    public function gameNew(GameRepository $gameRepository, NoteRepository $noteRepository, Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        // Partie gestion du formulaire
        if ($form->isSubmitted() && $form->isValid()) 
        {
            // Gestion de l'image uploadée
            $imageFile = $form->get('image')->getData();
            if ($imageFile)
            {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // On génère un nom de fichier unique
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // On déplace le fichier dans le dossier public/images
                try 
                {
                    $imageFile->move(
                        $this->getParameter('game_images_directory'),
                        $newFilename
                    );
                } 
                catch (FileException $e) 
                {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }

                // On set le nom de l'image dans l'entité
                $game->setImagePath($newFilename);
            }

            // On récupère les notes du jeu
            $userNote = $form->get('note')->get('userNote')->getData();
            $mediaNote = $form->get('note')->get('mediaNote')->getData();

            // On crée une nouvelle ligne dans la BDD et on set les notes
            $note = new Note();
            $note->setUserNote($userNote);
            $note->setMediaNote($mediaNote);
            // On enregistre la note dans la BDD
            $noteRepository->save($note, true);
            // On récupère l'id de la note et on set la note dans le jeu
            $game->setNote($noteRepository->find($note->getId()));

            // On enregistre le jeu dans la BDD
            $gameRepository->save($game, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        // Partie où on rend la vue du formulaire
        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form
        ]);
    }

    /**
     * Méthode pour éditer un jeu
     * @Route("/edit/{id}", name="app_game_edit", methods={"GET", "POST"})
     * @param Game $game
     * @param Request $request
     * @param GameRepository $gameRepository
     * @return Response
     */
    #[Route("/edit/{id}", name: "app_game_edit", methods: ['GET', 'POST'])]
    public function edit(Game $game, GameRepository $gameRepository, Request $request): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        // Partie gestion du formulaire
        if ($form->isSubmitted() && $form->isValid()) 
        {
            // Gestion de l'image uploadée
            $imageFile = $form->get('image')->getData();
            if ($imageFile)
            {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // On génère un nom de fichier unique
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                // On déplace le fichier dans le dossier public/images
                try 
                {
                    $imageFile->move(
                        $this->getParameter('game_images_directory'),
                        $newFilename
                    );
                } 
                catch (FileException $e) 
                {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }

                // On set le nom de l'image dans l'entité
                $game->setImagePath($newFilename);
            }

            // On enregistre le jeu dans la BDD
            $gameRepository->save($game, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        // Partie où on rend la vue du formulaire
        return $this->render('game/edit.html.twig', [
            'game' => $game,
            'form' => $form
        ]);        
    }
}
