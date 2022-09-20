<?php

namespace App\Controller;

use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
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
        return $this->render('basket/index.html.twig', compact("dataPanier", "total", "categories"));
    }
    // ette fonction sert a ajouter un produit au panier
    #[Route('/basket/add/{id}', name: 'app_basket_add')]
    public function add(Produits $product, SessionInterface $session){
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else {
            $panier[$id] = 1;
        }
        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("app_basket");
    }
    // cette fonction sert a enlever un element du panier
    #[Route('/basket/remove/{id}', name: 'app_basket_remove')]
    public function remove(Produits $product, SessionInterface $session){
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            // si le nombre de produit dans le panier et supérieur a 1 alor je décrémente
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                // sinon je suprime le panier
                unset($panier[$id]);
            }
    }
       // On sauvegarde dans la session
       $session->set("panier", $panier);

       return $this->redirectToRoute("app_basket");
    }
    // cette function sert a suprimer un élément du panier avec n'importe quel quantite
    #[Route('/basket/delete/{id}', name: 'app_basket_delete')]
    public function delete(Produits $product, SessionInterface $session){
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }
       // On sauvegarde dans la session
       $session->set("panier", $panier);

       return $this->redirectToRoute("app_basket");
    }

    #[Route('/basket/delete', name: 'app_basket_delete_all')]
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("app_basket");
    }
}
