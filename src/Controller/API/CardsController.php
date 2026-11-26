<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class CardsController extends AbstractController
{
    #[Route('/api/cards', name: 'api_cards', methods: ['GET'])]
    public function GET(CardRepository $cardRepository): JsonResponse
    {
        // $cards = [
        //     ['id' => 1, 'name' => 'Card 1'],
        //     ['id' => 2, 'name' => 'Card 2'],
        //     ['id' => 3, 'name' => 'Card 3'],
        // ];

        $cards = [];
        // if ($this->isGranted('ROLE_USER')) {
            return $this->json($cardRepository->findAll());
        // }else{
        //     return $this->json([], 403);
        // }

        return $this->json($cards);
    }

    #[Route('/api/cards/{id}', name: 'api_card', methods: ['GET'])]
    public function GETCard(int $id, CardRepository $cardRepository): JsonResponse
    {
        $card = $cardRepository->find($id);

        if (!$card) {
            return $this->json(['error' => 'Card not found'], 404);
        }

        return $this->json($card);
    }

    #[Route('/api/cards/type/{type}', name: 'api_cards_by_type', methods: ['GET'])]
    public function GETCardsByType(string $type, CardRepository $cardRepository): JsonResponse
    {
        $cards = $cardRepository->findBy(['type'=>$type]);

        if (empty($cards)) {
            return $this->json(['error' => 'No cards found for the specified type'], 404);
        }

        return $this->json($cards);
    }

    #[Route('/api/cards/item-type/{itemTypeId}', name: 'api_cards_by_item_type', methods: ['GET'])]
    public function GETCardsByItemType(int $itemTypeId, CardRepository $cardRepository  ): JsonResponse
    {
        $cards = $cardRepository->findBy(['item_type_id'=>$itemTypeId]);

        if (empty($cards)) {
            return $this->json(['error' => 'No cards found for the specified item type'], 404);
        }

        return $this->json($cards);
    }

    #[Route('/api/cards/name/{name}', name: 'api_cards_by_name', methods: ['GET'])]
    public function GETCardsByName(string $name, CardRepository $cardRepository): JsonResponse
    {
        $card = $cardRepository->findBy(['name'=>$name]);

        if (!$card) {
            return $this->json(['error' => 'Card not found for the specified name'], 404);
        }

        return $this->json($card);
    }
}