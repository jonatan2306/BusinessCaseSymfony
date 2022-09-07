<?php

namespace App\Controller\Admin;

use App\Entity\Commandes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommandesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commandes::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
