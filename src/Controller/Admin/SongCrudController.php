<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class SongCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Song::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield AssociationField::new('album','Альбом');
		yield AssociationField::new('author', 'Автор');
		yield TextField::new('name', 'Название песни');
		yield TextField::new('duration', 'Длительность');
		yield DateTimeField::new('release_date', 'Дата выхода');
	}
}