<?php

namespace App\Controller\Admin;

use App\Entity\CategorieProduit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieProduit::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
        ];
    }
}
