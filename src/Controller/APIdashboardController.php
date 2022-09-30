<?php

namespace App\Controller;

use App\Repository\CommandesRepository;
use App\Repository\PanierRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


/*
Montant Total des ventes
- Nb de nouveaux clients
- % de récurrence de commandes clients (un client déjà inscrit à re-commander,
rapport entre le nb de commandes avec nouveaux clients sur la plage
sélectionnée et le nb de commandes avec clients existants)
- % de paniers abandonnées (% de paniers qui n’ont pas été convertis en
commandes)
- Nb de visites
- % de conversion paniers (% entre le nb de visites et le nombre de paniers créés)
- % de conversion commandes (% entre le nb de paniers et le nombre de
commandes créées)
- Total de produits vendus triés par ordre décroissant (Le produit le plus vendu
sera en tête de liste, afficher le nombre d’unités vendues pour chaque produit)
*/
#[Route('/api')]
class APIdashboardController extends AbstractController
{
    #[Route('/', name: 'app_api_dashboard', methods: ['GET'])]
    public function index(CommandesRepository $commandesRepository,
    UserRepository $userRepository, PanierRepository $panierRepository
    ): JsonResponse
    {
        // get Nb de commandes
        $commandes = $commandesRepository->findAll();
        $paniers = $panierRepository->findAll();
        $sumPrixPanier = $panierRepository->getSumPrixPanier();

    // le premier parametre est la donnée, le deuxieme le code status, le troisieme, le header de la requete, le quatrieme verifie si
    // on envoie des données en JSON pour que le resultat s'envoi en json ou pas
        return new JsonResponse(json_encode([
            "nombre_commandes" => count($commandes),
            "nombre_paniers" => count($paniers),
            "panier_moyen" => $sumPrixPanier[1] / count($paniers)
            ])
            , Response::HTTP_OK, [], true);
    }
}
