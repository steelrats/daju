<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CameraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camera::class;
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
