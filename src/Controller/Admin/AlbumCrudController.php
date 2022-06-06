<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlbumCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Album::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield AssociationField::new('group')->setDisabled();
		yield TextField::new('name');
		yield TextField::new('info');
		yield AssociationField::new('genre');
		yield ImageField::new('cover')
						->setBasePath('uploads/cover')
						->setUploadDir('public/uploads/cover')
						->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
		yield DateField::new('release_date');
	}
}