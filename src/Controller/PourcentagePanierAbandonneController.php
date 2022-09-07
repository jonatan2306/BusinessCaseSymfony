<?php

namespace App\Controller;

use App\Repository\PanierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PourcentagePanierAbandonneControllerController extends AbstractController
{
    public function __construct(
        private PanierRepository $panierRepository
    ){}

    public function __invoke(): JsonResponse
    {

        $paniers = $this->panierRepository->obtenirLePourcentageDuPanier();
        return new JsonResponse(json_encode(['data' => $paniers]));
    }
}
