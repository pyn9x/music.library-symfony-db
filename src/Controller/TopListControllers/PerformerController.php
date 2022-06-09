<?php

namespace App\Controller\TopListControllers;

use App\Entity\Album;
use App\Entity\Performer;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PerformerController extends AbstractController
{
	#[Route('/performers', name: 'performers')]
	public function showAllAlbums(ManagerRegistry $doctrine): Response
	{
		$performers = $doctrine->getRepository(Performer::class)->findAll();
		return $this->render('top_list/performer/performers_all.html.twig', [
			'performers' => $performers,
		]);
	}

	#[Route('/performer/details/{id}', name: 'performer_details', methods: ['GET'])]
	public function showDetailsAlbums(ManagerRegistry $doctrine, int $id): Response
	{
		$performer = $doctrine->getRepository(Performer::class)->find($id);

		return $this->render('top_list/performer/performer_details.html.twig',['performer' => $performer]);
	}
}