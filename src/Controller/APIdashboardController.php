<?php

namespace App\Controller;

use App\Repository\CommandesRepository;
use App\Repository\PanierRepository;
use App\Repository\UserRepository;
use App\Repository\VisitorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Date;


/*
- % de récurrence de commandes clients (un client déjà inscrit à re-commander,
rapport entre le nb de commandes avec nouveaux clients sur la plage
sélectionnée et le nb de commandes avec clients existants)
- % de conversion paniers (% entre le nb de visites et le nombre de paniers créés)
- Total de produits vendus triés par ordre décroissant (Le produit le plus vendu
sera en tête de liste, afficher le nombre d’unités vendues pour chaque produit)
*/
#[Route('/api')]
class APIdashboardController extends AbstractController
{
    #[Route('/', name: 'app_api_dashboard', methods: ['GET'])] 
    public function index(CommandesRepository $commandesRepository,
    UserRepository $userRepository, PanierRepository $panierRepository,
    VisitorRepository $visitorRepository
    ): JsonResponse
    {
        // get counter visitor
        $counterVisitor = $visitorRepository->findAll();
        // get Nb de commandes
        $commandes = $commandesRepository->findAll();
        // get nb panier
        $paniers = $panierRepository->findAll();
        // get moyenne prix panier
        $sumPrixPanier = $panierRepository->getSumPrixPanier();
        // get new client today
        $newClientTodayNumber = $userRepository->findByRole('ROLE_USER');
        $nbNewUser = 0;
        foreach($newClientTodayNumber as $id => $user) {
            // si la date de creation du compte de l'utilisateur est === 0 on incremente le nombre de new user
            // ->d pour recuperer la valeur dans lobjet DateTimeImmutable

            if(date_diff($user->getCreatedAt(), new \DateTimeImmutable())->d === 0){
                $nbNewUser += 1;
            }
        }
        //  % de récurrence de commandes clients (un client déjà inscrit à re-commander,
        //rapport entre le nb de commandes avec nouveaux clients sur la plage
        //sélectionnée et le nb de commandes avec clients existants)

        // % de paniers abandonnées
        $paniersAbandon = 0;
        foreach($paniers as $id => $panier) {
            // on boucle sur notre vairable panier qui contient tous nos panier pour eviter de refaire une requete a la bdd
            // on verifie quelles paniers son abandonner via le statut "abandon"
            if($panier->getStatus() === "abandon"){
                $paniersAbandon += 1;
            }
        }
        // montant total des ventes
        $totalVentes = 0;
        foreach($commandes as $id => $order) {
        // on boucle sur notre vairable commande qui contient toutes nos commandes po
            // on additionne les prix          
            $totalVentes += $order->getPrix();
       
        }


        /*- % de conversion commandes (% entre le nb de paniers et le nombre de
            commandes créées)*/
    // le premier parametr  e est la donnée, le deuxieme le code status, le troisieme, le header de la requete, le quatrieme verifie si
    // on envoie des données en JSON pour que le resultat s'envoi en json ou pas
        return new JsonResponse(json_encode([
            "counter_visitor" => count($counterVisitor),
            "montant_total_ventes" => $totalVentes,
            "nombre_commandes" => count($commandes),
            "nombre_paniers" => count($paniers),
            "panier_moyen" => $sumPrixPanier[1] !== null ? $sumPrixPanier[1] / count($paniers) : 0,
            "new_client_today" => $nbNewUser,
            "panier_abandon" => $paniersAbandon  > 0 ?  ($paniersAbandon / count($paniers)) * 100 : 0, // (panier abandon / total panier) * 100
            "conversion_commandes" => count($paniers) > 0 || count($commandes) > 0 ? (count($paniers) / count($commandes)) * 100 : 0, // (panier abandon / total panier) * 100
            ])
            , Response::HTTP_OK, [], true);
    }
}
