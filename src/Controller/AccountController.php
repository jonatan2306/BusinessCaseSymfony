<?php

namespace App\Controller;

use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AdresseRepository;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(AdresseRepository $adresseRepository,
                          CategorieProduitRepository $categorieProduitRepository
    ): Response
    {
        return $this->render('account/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
            'categories' => $categorieProduitRepository->findAll()

        ]);
    }
}
