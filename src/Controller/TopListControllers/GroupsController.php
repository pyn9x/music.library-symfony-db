<?php

namespace App\Controller\TopListControllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GroupsController extends AbstractController
{
    #[Route('/groups', name: 'groups')]
    public function index(): Response
    {
        return $this->render('top_list/groups.html.twig', [
            'controller_name' => 'GroupsController',
        ]);
    }
}
