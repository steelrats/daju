<?php

namespace App\Controller\Admin;

use App\Entity\Fabriquant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class FabriquantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Fabriquant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield DateField::new('createdAt')->setDisabled();
    }
}
