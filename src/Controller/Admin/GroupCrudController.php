<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class GroupCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Group::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield TextField::new('name');
		yield TextField::new('info');
		yield ImageField::new('cover')
						->setBasePath('uploads/cover')
						->setUploadDir('public/uploads/cover')
						->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');

		yield DateField::new('date_of_creation');
	}
}