<?php
// le namespce représente  un moyen de séparer ses éléments au sein du code pour éviter les conflits ou collisions
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
        // si nous n'avons pas d'utilisateur
        if($this->getUser() === null){
            return $this->redirect('/login');
        }

        // Création d’une variable $url grâce a notre adminUrlGenerator qui vas générer la route correspondante a l’affichage de la liste des utilisateurs
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        // titre du dashboard admin
        return Dashboard::new()
            ->setTitle('BusinessCase');
    }

    public function configureMenuItems(): iterable
    {
        // méthode Yield qui génère plusieur éléments
        //Créer un Dashboard (Back-Office)
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // Créer des menu pour les user
        yield MenuItem::section('utilisateur');
        // créer des menu pour les actions
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            // Créer des sous-menu pour les user
            // il nous faut définir setAction() dans lequel on définit notre action « new » « show » etc…
            MenuItem::linkToCrud('Créer un utilisateur', 'fas fa-plus-circle', User::class)->setAction('new'),
            MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-eye', User::class)
        ]);
        //Créer une section pour les  Categories
        yield MenuItem::section('Categories');
        // Créer des menu pour les categories
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            // Créer des sous-menu pour les categories j’utilise la classe static MenuItem avec la fonction linkToCrud() qui me permet de donner un nom a mon menue avec son Icon correspondante
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
