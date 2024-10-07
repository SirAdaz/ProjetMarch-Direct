<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('userName', "Nom d'utilisateur"),
            TextField::new('tel', "Numéro de téléphone"),
            TextField::new('nameBusiness', "nom de l'entreprise"),
            ImageField::new('imageFileName') ->setUploadDir('public/images'),
            TextEditorField::new('descriptionCommerce'),
            TextField::new('numSiret', "Numéro de Siret"),
        ];
    }
}
