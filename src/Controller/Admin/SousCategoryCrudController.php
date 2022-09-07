<?php

namespace App\Controller\Admin;

use App\Entity\SousCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class SousCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SousCategory::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // "sert a ce que l'ID ne sois pas visible dans le formulaire"
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            // sert relier des entité entre elle
            AssociationField::new('categorie'),
        ];
    }
}
