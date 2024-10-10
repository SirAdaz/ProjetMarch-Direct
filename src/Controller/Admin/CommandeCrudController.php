<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('hourRecup', 'Heure de récupération'),
            AssociationField::new('historique', 'Historique'),
            AssociationField::new('UserCommande', 'Commerçant'),
            AssociationField::new('UserCommande', 'Client'),
            AssociationField::new('produit', 'Produits'),
            AssociationField::new('etat', 'Etat de la commande'),
            DateTimeField::new('date', 'Date de la commande'),
        ];
    }
}
