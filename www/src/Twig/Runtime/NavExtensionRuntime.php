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

    public function menuItemsConsole()
    {
        return $this->gameRepository->getCountGameByConsole();
    }

    public function menuItemsAge()
    {
        return $this->gameRepository->getCountGameByAge();
    }

    public function filtersItems()
    {
        return [
            ['label' => 'Prix', 'filter' => 'g.price ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Prix', 'filter' => 'g.price DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Date de sortie', 'filter' => 'g.releaseDate ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Date de sortie', 'filter' => 'g.releaseDate DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Note utilisateur', 'filter' => 'n.userNote ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Note utilisateur', 'filter' => 'n.userNote DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Note média', 'filter' => 'n.mediaNote ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Note média', 'filter' => 'n.mediaNote DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
        ];
    }

    public function numberFormat($number, $decimals = 2, $thousandsSep = ',', $decPoint = '.')
    {
        if ($number != 0) {
            return number_format($number, $decimals, $thousandsSep, $decPoint) . '€';
        } else {
            return 'Gratuit';
        }
        
    }
}
