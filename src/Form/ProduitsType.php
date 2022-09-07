<?php

namespace App\Form;

use App\Entity\Produits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('photoProduit')
            ->add('prix')
            ->add('titre')
            ->add('marque')
            ->add('quantite')
            ->add('categorieAppartenant')
            ->add('paniers')
            ->add('reduction')
            ->add('categorieProduit')
            ->add('marques')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
