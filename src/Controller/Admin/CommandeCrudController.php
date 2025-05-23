<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ArrayField::new('produits_commande'),
            AssociationField::new('UserCommande', 'Commerçant'),
            AssociationField::new('UserCommande', 'Client'),
            AssociationField::new('produits', 'Produits'),
            AssociationField::new('etat', 'Etat de la commande'),
        ];
    }
}
