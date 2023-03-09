<?php

namespace App\Controller\Admin;

use App\Entity\Fabriquant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FabriquantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fabriquant::class;
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
