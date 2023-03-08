<?php

namespace App\Controller\Admin;

use App\Entity\Drones;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DronesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drones::class;
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
