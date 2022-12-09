<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Produits;
use App\Form\ProduitsType;
use App\Repository\ProduitsRepository;
use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/produits')]
class ProduitsController extends AbstractController
{
    #[Route('/', name: 'app_produits_index', methods: ['GET'])]
    public function index(ProduitsRepository $produitsRepository, 
     CategorieProduitRepository $categorieProduitRepository,
     EntityManagerInterface $em, PaginatorInterface $paginator,
     Request $request
     
     ): Response
    {
        $data = new SearchData();
        $data->page = (int)$request->query->get('page', 1);
        $produits = $produitsRepository->findSearch($data);
    
        // $pagination = $paginator->paginate(
        //     $query, /* query NOT result */
        //     $request->query->getInt('page', 1), /*page number*/
        //     10 /*limit per page*/
        // );

        return $this->render('produits/index.html.twig', [
            'produits' => $produits->getItems(),
            'pagination' => $produits,
            'categories' => $categorieProduitRepository->findAll()
        ]);
    }

    #[Route('/category/{category}', name: 'app_produits_index_by_category', methods: ['GET'])]
    // cette fonction vas nous permettre de récupérer tous lesproduits de chaqque categorie
    public function showByCategory(
        ProduitsRepository $produitsRepository, $category,
         CategorieProduitRepository $categorieProduitRepository,
         EntityManagerInterface $em, PaginatorInterface $paginator,
         Request $request): Response
    {
        $data = new SearchData();
        $data->page = (int)$request->query->get('page', 1);
        $data->category = (int)$category;
        $produits = $produitsRepository->findSearch($data);
        // je récupère tous les produits qui sont ssociée a la categorie que l'on veux
        //dd($$produits->getItems());
        // foreach ($produits->getItems() as $key => $value){
        //     //commandes
        // }
        return $this->render('produits/index.html.twig', [
            // 'produits' => $categorieProduitRepository->findOneBy(['id' => $category])->getProduits(),
            'produits' => $produits->getItems(),
            'categories' => $categorieProduitRepository->findAll(),
            'pagination' => $produits,
        ]);
    }
    #[Route('/new', name: 'app_produits_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitsRepository $produitsRepository): Response
    {
        $produit = new Produits();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_produits_show', methods: ['GET'])]
    public function show(Produits $produit, CategorieProduitRepository $categorieProduitRepository): Response
    {
        return $this->render('produits/show.html.twig', [
            'produit' => $produit,
            'categories' => $categorieProduitRepository->findAll()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produits_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produitsRepository->add($produit, true);

            return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produits/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produits_delete', methods: ['POST'])]
    public function delete(Request $request, Produits $produit, ProduitsRepository $produitsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $produitsRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_produits_index', [], Response::HTTP_SEE_OTHER);
    }
}
