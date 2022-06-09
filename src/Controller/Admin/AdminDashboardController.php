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
			MenuItem::linkToRoute('Home', 'fas fa-home', 'index'),
			//MenuItem::linkToCrud('User', 'fas fa-map-marker-alt', User::class),
			MenuItem::linkToCrud('Group', 'fas fa-map-marker-alt', Group::class),
			MenuItem::linkToCrud('Album', 'fas fa-map-marker-alt', Album::class),
			MenuItem::linkToCrud('Song', 'fas fa-map-marker-alt', Song::class),
			MenuItem::linkToCrud('Genre', 'fas fa-map-marker-alt', Genre::class),
			MenuItem::linkToCrud('Country', 'fas fa-map-marker-alt', Country::class),
			MenuItem::linkToCrud('Performer', 'fas fa-map-marker-alt', Performer::class),
			MenuItem::linkToCrud('Role', 'fas fa-map-marker-alt', Role::class),
		];
    }
}
