<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	#[ORM\Column(type: 'string', length: 255)]
	private $name;

	#[ORM\Column(type: 'date')]
	private $release_date;

	#[ORM\ManyToMany(targetEntity: Group::class, mappedBy: "album")]
	private $group;

	#[ORM\Column(type: 'string', length: 512)]
	private $info;

	#[ORM\Column(nullable: true)]
	protected ?string $cover;

	#[ORM\ManyToMany(targetEntity: Song::class, mappedBy: 'album')]
	private $songs;

	#[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: "album")]
	private $genre;

	public function __construct()
	{
		$this->group = new ArrayCollection();
		$this->songs = new ArrayCollection();
		$this->genre = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getReleaseDate(): ?\DateTimeInterface
	{
		return $this->release_date;
	}

	public function setReleaseDate(\DateTimeInterface $release_date): self
	{
		$this->release_date = $release_date;

		return $this;
	}

	public function getCover(): ?string
	{
		return $this->cover;
	}

	public function setCover(?string $cover): self
	{
		$this->cover = $cover;

		return $this;
	}

	public function getCoverUrl(): ?string
	{
		if (!$this->cover)
		{
			return null;
		}
		if (str_contains($this->cover, '/'))
		{
			return $this->cover;
		}

		return sprintf('/uploads/cover/%s', $this->cover);
	}

	/**
	 * @return Collection<int, Group>
	 */
	public function getGroup(): Collection
	{
		return $this->group;
	}

	public function addGroup(Group $group): self
	{
		if (!$this->group->contains($group))
		{
			$this->group[] = $group;
			$group->addAlbum($this);
		}

		return $this;
	}

	public function removeGroup(Group $group): self
	{
		if ($this->group->removeElement($group))
		{
			$group->removeAlbum($this);
		}

		return $this;
	}

	public function __toString()
	{
		return $this->name;
	}

	/**
	 * @return Collection<int, Song>
	 */
	public function getSongs(): Collection
	{
		return $this->songs;
	}

	public function addSong(Song $song): self
	{
		if (!$this->songs->contains($song))
		{
			$this->songs[] = $song;
			$song->addAlbum($this);
		}

		return $this;
	}

	public function removeSong(Song $song): self
	{
		if ($this->songs->removeElement($song))
		{
			$song->removeAlbum($this);
		}

		return $this;
	}

	public function getInfo(): ?string
	{
		return $this->info;
	}

	public function setInfo(string $info): self
	{
		$this->info = $info;

		return $this;
	}

	/**
	 * @return Collection<int, Genre>
	 */
	public function getGenre(): Collection
	{
		return $this->genre;
	}

	public function addGenre(Genre $genre): self
	{
		if (!$this->genre->contains($genre))
		{
			$this->genre[] = $genre;
		}

		return $this;
	}

	public function removeGenre(Genre $genre): self
	{
		$this->genre->removeElement($genre);

		return $this;
	}
}
