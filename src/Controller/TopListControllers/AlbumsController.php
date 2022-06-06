<?php

namespace App\Controller\TopListControllers;

use App\Entity\Album;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Group;

class AlbumsController extends AbstractController
{
	#[Route('/albums', name: 'albums')]
	public function showAllAlbums(ManagerRegistry $doctrine): Response
	{
		$albums = $doctrine->getRepository(Album::class)->findAll();
		return $this->render('top_list/albums/albums_all.html.twig', [
			'albums' => $albums,
		]);
	}

	#[Route('/albums/details/{id}', name: 'albums_details', methods: ['GET'])]
	public function showDetailsAlbums(ManagerRegistry $doctrine, int $id): Response
	{
		$album = $doctrine->getRepository(Album::class)->find($id);

		return $this->render('top_list/albums/album_details.html.twig',['album' => $album]);
	}
}
