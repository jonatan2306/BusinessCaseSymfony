<?php

namespace App\Controller\Admin;

use App\Entity\Produits;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
// importation de l'id
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
// importation de l'image
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
// importation du textarea
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
// importation du texte 
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
// importation du price
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
// importation pour la quantite
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
// importation les boolean (actif ou nn)
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
class ProduitsCrudController extends AbstractCrudController
{
    // je créer une constante pour y mettre le chemin de l'url pour sauvgegarder et accéder aux images
    // le dossier ou on vas les appelées
    public const PRODUCTS_BASE_PATH = 'upload/images/products';
    // le dossier ou on vas les uploads
    public const PRODUCTS_UPLOAD_DIR = 'public/upload/images/products';

    public static function getEntityFqcn(): string
    {
        return Produits::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // le "hideOnForm" sert a ce que l'id du produit ne sois pas visible dans le tableau bootstrap
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextEditorField::new('description'),
            ImageField::new('photoProduit')
            ->setBasePath(self::PRODUCTS_BASE_PATH)
            ->setUploadDir(self::PRODUCTS_UPLOAD_DIR)
            ->setSortable(false),
            MoneyField::new('prix')->setCurrency('EUR'),
            MoneyField::new('prixHT')->setCurrency('EUR'),
            IntegerField::new('quantite'),
            BooleanField::new('actif'),
            AssociationField::new('Categorie'),
        ];
    }
}
