<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CameraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camera::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield NumberField::new('ouverture');
        yield TextField::new('resolutionVertical');
        yield TextField::new('resolutionHorizontal');
        yield IntegerField::new('fov');
        yield BooleanField::new('stabilise');
    }
}
