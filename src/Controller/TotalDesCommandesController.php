<?php

namespace App\Controller;

use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class TotalDesCommandesController extends AbstractController
{

    public function __construct(
       private PanierRepository $panierRepository
    ){}

    public function __invoke(): JsonResponse
    {
       $commande = $this->panierRepository->getTotalcommande();
        return new JsonResponse(json_encode(['data' => $commande]));
    }
}
