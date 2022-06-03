<?php

namespace App\Controller\TopListControllers;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Group;

class GroupsController extends AbstractController
{
    #[Route('/groups', name: 'groups')]
    public function showAllGroups(ManagerRegistry $doctrine): Response
    {
		$groups = $doctrine->getRepository(Group::class)->findAll();

        return $this->render('top_list/groups.html.twig', [
            'groups' => $groups,
        ]);
    }
}
