<?php

namespace App\Controller;
use App\TKStats\TKStats;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TKStatsController extends AbstractController
{
    #[Route('/replays/{playerId}', methods: ['GET'])]
    public function show(int $playerId): JsonResponse
    {
        $tkStats = new TKStats();
        return $this->json($tkStats->getWavuPlayerStats($playerId));
    }
}