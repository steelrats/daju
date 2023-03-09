<?php

namespace App\Controller\Admin;

use App\Entity\Drones;
use App\Entity\Camera;
use App\Entity\Fabriquant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
    }
}
