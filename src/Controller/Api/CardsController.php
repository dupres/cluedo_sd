<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CardRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Dto\CardFilter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

#[Route('/api/cards', name:'api_cards_')]
class CardsController extends AbstractController
{
    // #[Route('/api/cards', name: 'api_cards', methods: ['GET'])]
    // public function GET(CardRepository $cardRepository): JsonResponse
    // {
    //     $cards = [];
    //     // if ($this->isGranted('ROLE_USER')) {
    //         return $this->json($cardRepository->findAll());
    //     // }else{
    //     //     return $this->json([], 403);
    //     // }

    //     return $this->json($cards);
    // }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(CardRepository $cardRepository, #[MapQueryString(validationFailedStatusCode: Response::HTTP_BAD_REQUEST)] ?CardFilter $filters=null): JsonResponse
    {
        $cards = $cardRepository->findByFilters($filters);
        return $this->json($cards);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id, CardRepository $cardRepository): JsonResponse
    {
        $card = $cardRepository->find($id);
        if (!$card) {
            return $this->json(['error' => 'Card not found'], 404);
        }
        return $this->json($card);
    }


    #[Route('/type/{type}', name: 'listByType', methods: ['GET'])]
    public function listByType(string $type, CardRepository $cardRepository): JsonResponse
    {
        $cards = $cardRepository->findBy(['type'=>$type]);

        if (empty($cards)) {
            return $this->json(['error' => 'No cards found for the specified type'], 404);
        }

        return $this->json($cards);
    }

    #[Route('/item-type/{itemTypeId}', name: 'listByItemType', methods: ['GET'])]
    public function listByItemType(int $itemTypeId, CardRepository $cardRepository  ): JsonResponse
    {
        $cards = $cardRepository->findBy(['item_type_id'=>$itemTypeId]);

        if (empty($cards)) {
            return $this->json(['error' => 'No cards found for the specified item type'], 404);
        }

        return $this->json($cards);
    }

    #[Route('/name/{name}', name: 'listByName', methods: ['GET'])]
    public function listByName(string $name, CardRepository $cardRepository): JsonResponse
    {
        $card = $cardRepository->findBy(['name'=>$name]);

        if (!$card) {
            return $this->json(['error' => 'Card not found for the specified name'], 404);
        }

        return $this->json($card);
    }
}