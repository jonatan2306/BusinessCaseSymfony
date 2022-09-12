<?php

namespace App\Controller\Admin;

use App\Entity\Commandes;
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

class CommandesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commandes::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // hideOnForm permet de cacher dans le formulaire
            //hideOnDetail   permet de cacher  l'id dans le formulaaire quand tu vas le créer
            IdField::new('id')->hideOnForm()->hideOnDetail(),
            MoneyField::new('prix')->setCurrency('EUR'),
            AssociationField::new('moyenPaiement'),
            AssociationField::new('user'),
            AssociationField::new('adresse'),
            AssociationField::new('produit'),
            AssociationField::new('statut'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('updatedAt'),
        ];
    }
}
