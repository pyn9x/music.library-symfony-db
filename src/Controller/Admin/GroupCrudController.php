<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GroupCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Group::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield TextField::new('name', 'Название альбома');
		yield TextField::new('info', 'Информация о группе');
		yield AssociationField::new('genre', 'Жанр');
		yield AssociationField::new('album', 'Альбомы группы');
		yield AssociationField::new('performer', 'Участники группы');
		yield AssociationField::new('country', 'Страна');
		yield ImageField::new('cover')->setBasePath('uploads/cover')->setUploadDir('public/uploads/cover')
						->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');

		yield DateField::new('date_of_creation', 'Дата создания');
		yield DateField::new('breakup', 'Дата расспада');
	}
}