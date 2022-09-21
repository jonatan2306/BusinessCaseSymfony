<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\ProduitsRepository;
use App\Repository\StatutRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(SessionInterface $session, ProduitsRepository $produitsRepository, CategorieProduitRepository $categorieProduitRepository): Response
    {
        $panier = $session->get('panier', []);

        $dataPanier = [];
        $total = 0;
        // on créer un tableau dans lequel on vas stochker e ifférent propduits ajouter
        foreach($panier as $id => $quantite){
            // $pruduct stocke un par un chaque produit ajouter
            $product = $produitsRepository->find($id);
            // $datapanier sert a mettre les éléments et reformater nos données
            $dataPanier[] = [
                "produit" => $product,
                "quantite" => $quantite
            ];
            // cette variable calcul le prix de la quantité de tous les produits
            $total += $product->getPrix() * $quantite;
        }
        $categories = $categorieProduitRepository->findAll();

        // le "compact() créer un tableau et reprend la variable data"
        return $this->render('checkout/index.html.twig', compact("dataPanier", "total", "categories"));
    }

    #[Route('/checkout/payment', name: 'app_checkout_process_payment')]
    public function processPayment(SessionInterface $session,
                                   ProduitsRepository $produitsRepository,
                                   Request $request, EntityManagerInterface $em, StatutRepository $statutRepository,
                                   CategorieProduitRepository $categorieProduitRepository,
    ): Response
    {
        $commandes = new Commandes();
        $panier = $session->get('panier', []);
        $dataPanier = [];
        $total = 0;
        // on créer un tableau dans lequel on vas stochker e ifférent propduits ajouter
        foreach($panier as $id => $quantite){
            // $pruduct stocke un par un chaque produit ajouter
            $product = $produitsRepository->find($id);
            // $datapanier sert a mettre les éléments et reformater nos données
            $dataPanier[] = [
                "produit" => $product,
                "quantite" => $quantite
            ];
            /*   // quand on vas procéder a l'achat on vas décrémenté un article a chaque fois qu'on enlève un article
               $panier->setQuantite($product->getQuantite() - 1);
               // "em" correspond a l'entité manager
               $em->persist($panier);
               $em->flush();*/
            // cette variable calcul le prix de la quantité de tous les produits
            $total += $product->getPrix() * $quantite;
        }
        // si la commandes est correcte j'affiche le statut 1 "valider"
        $status = $statutRepository->find('1');
        $commandes
            ->setPrix($total)
            ->setMoyenPaiement($request->request->get('moyenPaiement'))
            ->setUser($this->getUser())
            ->setStatut($status)
            ->setAdresse($request->request->get('addresse'))
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());
        foreach($dataPanier as $quantite){
            $product = $produitsRepository->find($quantite['produit']->getId());
            $commandes->addProduit($product);
        }
        $em->persist($commandes);
        $em->flush();
        $categories = $categorieProduitRepository->findAll();
        $session->remove("panier");

        return $this->render('checkout/checkout_completed.html.twig', compact("dataPanier", "total", "categories"));
    }
}
