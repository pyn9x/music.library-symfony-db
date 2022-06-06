<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	#[ORM\Column(type: 'string', length: 255)]
	private $name;

	#[ORM\ManyToMany(targetEntity: Group::class, mappedBy: "genre")]
	private $group;

	#[ORM\ManyToMany(targetEntity: Album::class, mappedBy: "genre")]
	private $album;

	public function __construct()
	{
		$this->group = new ArrayCollection();
		$this->album = new ArrayCollection();
	}

	public function addGroup(Group $group): self
	{
		if (!$this->group->contains($group))
		{
			$this->group[] = $group;
			$group->addGenre($this);
		}

		return $this;
	}

	public function removeGroup(Group $group): self
	{
		if ($this->group->removeElement($group))
		{
			$group->removeGenre($this);
		}

		return $this;
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

	/**
	 * @return mixed
	 */
	public function getGroup(): Collection
	{
		return $this->group;
	}

	/**
	 * @param mixed $group
	 */
	public function setGroup($group): void
	{
		$this->group = $group;
	}

	public function __toString()
	{
		return $this->name;
	}

	/**
	 * @return Collection<int, Album>
	 */
	public function getAlbum(): Collection
	{
		return $this->album;
	}

	public function addAlbum(Album $album): self
	{
		if (!$this->album->contains($album))
		{
			$this->album[] = $album;
			$album->addGenre($this);
		}

		return $this;
	}

	public function removeAlbum(Album $album): self
	{
		if ($this->album->removeElement($album))
		{
			$album->removeGenre($this);
		}

		return $this;
	}
}
