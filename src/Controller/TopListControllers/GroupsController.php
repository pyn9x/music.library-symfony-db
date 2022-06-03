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

        return $this->render('top_list/groups/groups_all.html.twig', [
            'groups' => $groups,
        ]);
    }

	#[Route('/groups/details/{id}', name: 'groups_details', methods: ['GET'])]
	public function showDetailsGroup(ManagerRegistry $doctrine, int $id): Response
	{
		$group = $doctrine->getRepository(Group::class)->find($id);

		return $this->render('top_list/groups/group_details.html.twig', [
			'group' => $group,
		]);
	}
}
