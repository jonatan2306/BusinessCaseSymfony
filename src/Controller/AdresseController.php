<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseType;
use App\Repository\AdresseRepository;
use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/adresse')]
class AdresseController extends AbstractController
{
    #[Route('/', name: 'app_adresse_index', methods: ['GET'])]
    public function index(AdresseRepository $adresseRepository,
        CategorieProduitRepository $categorieProduitRepository
    ): Response
    {
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
            'categories' => $categorieProduitRepository->findAll()
        ]);
    }
    // cette fonction sert créer une nouvelle categorie on prend les donné avec "GET" et on les envoie avec "POST"
    #[Route('/new', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AdresseRepository $adresseRepository,
        CategorieProduitRepository $categorieProduitRepository

    ): Response
    // comme réponse sa nous créer une nouvelle adresse 
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // si l'utilisateur a rentrer les bonnes informations et qu'il est connecté
            $adresse->setUser($this->getUser());
            // je le connecte en tant qu'utilisateur
            $adresseRepository->add($adresse, true);
            // je le redirige vers 'app_adresse_index' qui est la page d'accueil
            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }
        // si non je le redirige vers le formulaire de connection
        return $this->renderForm('adresse/new.html.twig', [
            'adresse' => $adresse,
            'categories' => $categorieProduitRepository->findAll(),
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse,
        CategorieProduitRepository $categorieProduitRepository

    ): Response
    // en réponse je lui renvoie le tableu ou son afficher toutes les adresses
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
            'categories' => $categorieProduitRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, AdresseRepository $adresseRepository,                           CategorieProduitRepository $categorieProduitRepository
    ): Response
    {
        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adresseRepository->add($adresse, true);

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
            'categories' => $categorieProduitRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, AdresseRepository $adresseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->request->get('_token'))) {
            $adresseRepository->remove($adresse, true);
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
