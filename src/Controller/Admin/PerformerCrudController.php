<?php

namespace App\Controller\Admin;


use App\Entity\Performer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PerformerCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Performer::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield TextField::new('surname' , 'Фамилия');
		yield TextField::new('name' , 'Имя');
		yield AssociationField::new('country' , 'Страна');
		yield DateField::new('birthday', 'День рождения');
		yield ImageField::new('cover', 'Фото')
						->setBasePath('uploads/cover')
						->setUploadDir('public/uploads/cover')
						->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
		yield AssociationField::new('role', 'Роль');
	}
}