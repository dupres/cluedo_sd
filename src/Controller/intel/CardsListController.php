<?php

namespace App\Controller\intel;

use App\Entity\Card;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Repository\CardRepository;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use App\Dto\CardFilter;

class CardsListController extends AbstractController
{
    #[Route('/intel/cards', name: 'intel_cards')]
    public function index(CardRepository $cardRepository, #[MapQueryString] ?CardFilter $filters = null): Response
    {
        // Ajouter Request $request aux paramètres de la méthode
        // $name = $request->query->get('name');
        
        // ou #[MapQueryParameter]
        // puis ?string $namme = null dans la méthode



        // $cards = $cardRepository->findAll();

        $cards = $cardRepository->findByFilters($filters);
        $card_types = $cardRepository->findDistinctTypes();


        return $this->render('intel/card/list.html.twig', [
            'cards' => $cards,
            'card_types' => $card_types,
            'filters' => $filters??(new CardFilter())
        ]);
    }
}