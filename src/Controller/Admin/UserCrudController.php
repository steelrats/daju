<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('username');

        yield TextField::new('password')
                    ->setFormType(RepeatedType::class)
                    ->setFormTypeOptions([
                        'type' => PasswordType::class,
                        'invalid_message' => 'The password fields must match.',
                        'required' => true,
                        'first_options'  => ['label' => 'Password'],
                        'second_options' => ['label' => 'Repeat Password'],
                    ]);
        
        yield TextField::new('email');
        yield BooleanField::new('isActive');
        $roles = ["ADMIN" => "ROLE_ADMIN", "USER" => "ROLE_USER"];
        yield ChoiceField::new('roles')
                    ->allowMultipleChoices()
                    ->setChoices($roles);
        yield DateField::new('createdAt')->setDisabled();
    }

    public function createEntity(string $entityFqcn)
    {
        return new User();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $entityInstance->setUpdatedAt(new \DateTime());
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($entityInstance, $entityInstance->getPassword());
        $entityInstance->setPassword($hashedPassword);
        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityLabelInSingular('User')
                    ->setEntityLabelInPlural('Users')
                    ->setPageTitle('index', 'Users List')
                    ->setPageTitle('new', 'Create User')
                    ->setPageTitle('edit', 'Edit User')
                    ->setPageTitle('detail', 'User Details');
    }

}
