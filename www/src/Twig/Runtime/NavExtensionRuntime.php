<?php

namespace App\Twig\Runtime;

use App\Repository\GameRepository;
use Twig\Extension\RuntimeExtensionInterface;

class NavExtensionRuntime implements RuntimeExtensionInterface
{
    // On va déclarer une variable en private pour stocker l'instance de GameRepository
    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        // On va instancier GameRepository
        $this->gameRepository = $gameRepository;
    }

    public function menu_items()
    {
        return $this->gameRepository->getCountGameByConsole();
    }
}
