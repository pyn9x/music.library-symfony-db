<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use App\Entity\User;
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

		return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
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
			MenuItem::linkToCrud('User', 'fas fa-map-marker-alt', User::class),
			MenuItem::linkToCrud('Group', 'fas fa-map-marker-alt', Group::class),
		];
    }
}
