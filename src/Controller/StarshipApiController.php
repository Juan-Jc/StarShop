<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('', methods:['GET'])]
    public function getCollection(LoggerInterface $logger, StarshipRepository $repository): Response
    {

        $logger->info('Starship collection retrieved');
        $starships = $repository->findAll();

        return $this->json($starships);
    }

    #[Route('/{id<\d+>}', ['GET'])]
    public function get(int $id, StarshipRepository $repository): JsonResponse
    {
        $starship = $repository->find($id);
        if(!$starship){
            throw $this->createNotFoundException('Starship not found');
        }
        return $this->json($starship);
    }
}