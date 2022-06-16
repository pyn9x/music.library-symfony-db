<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use App\Entity\Country;
use App\Entity\Genre;
use App\Entity\Group;
use App\Entity\Performer;
use App\Entity\Role;
use App\Entity\Song;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminDashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
		$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

		return $this->redirect($adminUrlGenerator->setController(GroupCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Music Library');
    }

    public function configureMenuItems(): iterable
    {
		return [
			MenuItem::linkToRoute('Главная Страница', 'fas fa-home', 'index'),
			//MenuItem::linkToCrud('User', 'fas fa-map-marker-alt', User::class),
			MenuItem::linkToCrud('Группы', 'fas fa-users', Group::class),
			MenuItem::linkToCrud('Альбомы', 'fas fa-compact-disc', Album::class),
			MenuItem::linkToCrud('Песни', 'fas fa-music', Song::class),
			MenuItem::linkToCrud('Исполнители', 'fa fa-user', Performer::class),
			MenuItem::linkToCrud('Жанры', 'fa fa-tags', Genre::class),
			MenuItem::linkToCrud('Страны', 'fa fa-globe-europe', Country::class),
			MenuItem::linkToCrud('Роли', 'fa fa-guitar', Role::class),
		];
    }
}
