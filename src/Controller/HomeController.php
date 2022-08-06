<?php

namespace App\Controller;

use App\Repository\CategorieProduitRepository;
use App\Repository\MarquesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        ProduitsRepository $produitsRepository,
        MarquesRepository $marquesRepository,
        CategorieProduitRepository $categorieProduitRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'categorieProduit' => $categorieProduitRepository->getGroupedByCategorie(),
            'tousLesProduits' => $produitsRepository->findAll(),
            'toutesLesMarques' => $marquesRepository->findAll()
        ]);
    }
}
