<?php

namespace App\Controller;

use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class NouveauClientController extends AbstractController
{
    public function __construct(
        private ClientsRepository $clientsRepository
    ) { }

    public function __invoke(): JsonResponse
    {
        $nouveauClient = $this->clientRepository->getNewClient();
        return new JsonResponse(json_encode(['data' => $nouveauClient]));
    }



}
