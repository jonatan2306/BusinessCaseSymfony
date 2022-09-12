<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
// importation de bla classe ChoiceField du bundle EasyAdminBundle pour permettre un choix
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail(),
            TextField::new('email'), 
            TextField::new('password')->hideOnDetail(),
            ChoiceField::new('roles')->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                // le dernier role de cette liste seras selectionner par default
                'ROLE_USER' => 'ROLE_USER',
            ])
            ->allowMultipleChoices()

        ];
    }

    public function persistEntity(
        EntityManagerInterface $entityManager,
        $entityInstance
    ): void {
        if (!$entityInstance instanceof User) return;

        $encodedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
        $entityInstance->setPassword($encodedPassword);

        parent::persistEntity($entityManager, $entityInstance);
        // generate a signed url and email it to the user
    }
}
