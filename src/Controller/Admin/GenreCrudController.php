<?php

namespace App\Controller\Admin;

use App\Entity\Genre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GenreCrudController extends AbstractCrudController
{
	public static function getEntityFqcn(): string
	{
		return Genre::class;
	}

	public function configureFields(string $pageName): iterable
	{
		yield IdField::new('id')->hideOnDetail()->hideOnForm();
		yield TextField::new('name', 'Жанр');
	}
}