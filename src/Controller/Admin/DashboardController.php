<?php

namespace App\Controller\Admin;

use App\Entity\CategorieProduit;
use App\Entity\Commandes;
use App\Entity\Produits;
use App\Entity\SousCategory;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator as RouterAdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    private RouterAdminUrlGenerator $adminUrlGenerator;

    public function __construct(RouterAdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
   
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        
        if($this->getUser() === null){
            return $this->redirect('/login');
        }
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        
        return Dashboard::new()
            ->setTitle('BusinessCase');
    }

    public function configureMenuItems(): iterable
    {
        //Créer un Dashboard (Back-Office)
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // Créer des menu pour les user
        yield MenuItem::section('utilisateur');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            // Créer des sous-menu pour les user
            MenuItem::linkToCrud('Créer un utilisateur', 'fas fa-plus-circle', User::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-eye', User::class)
        ]);
        //Créer une section pour les  Categories
        yield MenuItem::section('Categories');
        // Créer des menu pour les categories
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            // Créer des sous-menu pour les categories
            MenuItem::linkToCrud('Créer une catégorie', 'fas fa-plus-circle', CategorieProduit::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des categories', 'fas fa-eye', CategorieProduit::class)
        ]);
        //Créer une section pour les sous-Categories
        yield MenuItem::section('Sous-catégories');
        // Créer des menu pour les sous-categories
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
        // Créer des sous-menu pour les categories
        MenuItem::linkToCrud('Créer une sous-catégorie', 'fas fa-plus-circle', SousCategory::class)->setAction('new'),
        MenuItem::linkToCrud('Liste des sous-categories', 'fas fa-eye', SousCategory::class)
        ]);
        //Créer une section pour les produits
        yield MenuItem::section('Produits');
        // Créer des menu pour les sous-categories
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
        // Créer des sous-menu pour les categories
        MenuItem::linkToCrud('Créer un produit', 'fas fa-plus-circle', Produits::class)->setAction('new'),
        MenuItem::linkToCrud('Liste des produits', 'fas fa-eye', Produits::class)
        ]);

        //Créer une section pour les produits
        yield MenuItem::section('Commandes');
        // Créer des menu pour les sous-categories
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
        // Créer des sous-menu pour les categories
        MenuItem::linkToCrud('Créer une commande', 'fas fa-plus-circle', Commandes::class)->setAction('new'),
        MenuItem::linkToCrud('Liste des commande', 'fas fa-eye', Commandes::class)
        ]);
    }
}
