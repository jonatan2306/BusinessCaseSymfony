<?php

namespace App\Controller;

use App\Repository\CategorieProduitRepository;
use App\Repository\VisitorRepository;
use App\Repository\MarquesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Visitor;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CategorieProduitRepository $categorieProduitRepository,
        SessionInterface $session,
        VisitorRepository $visitorRepository
    ): Response
    {
        $currentSession = $session->get('visitor', []);
        // if la session visitor est vide, il na jamais visiter le site donc on set adresse ip du client pour garder sa trace
        if (empty($currentSession)){
            $visitor = (new Visitor())
            ->setAddrIp($_SERVER['REMOTE_ADDR'])
            ->setIsVisited(true);
            $visitorRepository->add($visitor, true);
            $session->set("visitor", $_SERVER['REMOTE_ADDR']);

        }
        dd($currentSession);
        return $this->render('home/index.html.twig', [
            'categories' => $categorieProduitRepository->findAll()
        ]);
    }
    public function getClientIps()
    {
        $ip = $this->server->get('REMOTE_ADDR');

        if (!$this->isFromTrustedProxy()) {
            return [$ip];
        }

        return $this->getTrustedValues(self::HEADER_X_FORWARDED_FOR, $ip) ?: [$ip];
    }
}
