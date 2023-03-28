<?php

namespace App\Controller\Admin;

use App\Entity\Camera;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class CameraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camera::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield NumberField::new('ouverture');
        yield IntegerField::new('resolutionHorizontal');
        yield IntegerField::new('resolutionVertical');
        yield IntegerField::new('fov');
        yield BooleanField::new('stabilise');
        yield DateField::new('createdAt')->setDisabled();
    }
}
