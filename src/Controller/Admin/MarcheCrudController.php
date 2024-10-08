<?php

namespace App\Controller\Admin;

use App\Entity\Marche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PhpParser\Node\Stmt\Label;

class MarcheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marche::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('marcheName'),
            TextField::new('place'),
            ImageField::new('imageFileName'),
            AssociationField::new('commercantMarche', 'user'),
            TextField::new('hourly'),
        ];
    }
}
