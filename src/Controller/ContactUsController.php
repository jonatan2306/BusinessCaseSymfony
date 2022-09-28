<?php

namespace App\Controller;

use App\Repository\CategorieProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    #[Route('/contact/us', name: 'app_contact_us')]
    public function index(
        CategorieProduitRepository $categorieProduitRepository,
        Request $request
    ): Response
    {
        $email = 'e';
        $message = 'r';
        return $this->render('contact_us/index.html.twig', [
            'categories' => $categorieProduitRepository->findAll()
        ]);
    }

}
