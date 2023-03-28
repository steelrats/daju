<?php

namespace App\Controller\Admin;

use App\Entity\Drones;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class DronesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Drones::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield AssociationField::new(('fabriquant'));
        yield IntegerField::new('prix');
        yield AssociationField::new('camera');
        yield IntegerField::new('vitesseVerticale');
        yield IntegerField::new('vitesseHorizon');
        yield IntegerField::new('poids');
        yield TextField::new('resistanceVent');
        yield ImageField::new('imageName')->setUploadDir('/public/img/uploads/')->setUploadedFileNamePattern('[timestamp]_[slug].[extension]')->setBasePath('img/uploads/');
        yield DateField::new('createdAt')->setDisabled();
        
    }
}
