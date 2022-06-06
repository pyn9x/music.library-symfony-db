<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupRepository::class)]
#[ORM\Table(name: '`group`')]
class Group
{
	#[ORM\Id]
   	#[ORM\GeneratedValue]
   	#[ORM\Column(type: 'integer')]
   	private $id;

	#[ORM\Column(type: 'string', length: 255)]
   	private $name;

	#[ORM\Column(type: 'date')]
   	private $dateOfCreation;

	#[ORM\Column(type: 'string', length: 512)]
   	private $info;

	#[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: "group")]
   	private $genre;

	#[ORM\ManyToMany(targetEntity: Album::class, inversedBy: "group")]
   	private $album;

	public function __construct()
   	{
   		$this->album = new ArrayCollection();
   		$this->genre = new ArrayCollection();
   	}

	public function addAlbum(Album $album): self
   	{
   		if (!$this->album->contains($album))
   		{
   			$this->album[] = $album;
   		}
   
   		return $this;
   	}

	public function removeAlbum(Album $album): self
   	{
   		$this->album->removeElement(($album));
   
   		return $this;
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
   		$this->genre->removeElement(($genre));
   
   		return $this;
   	}

	#[ORM\Column(nullable: true)]
   	protected ?string $cover;

	public function getId(): ?int
   	{
   		return $this->id;
   	}

	/**
	 * @return mixed
	 */
	public function getGenre(): Collection
   	{
   		return $this->genre;
   	}

	/**
	 * @param mixed $genre
	 */
	public function setGenre($genre): void
   	{
   		$this->genre = $genre;
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

	public function getDateOfCreation(): ?\DateTimeInterface
   	{
   		return $this->dateOfCreation;
   	}

	public function setDateOfCreation(\DateTimeInterface $dateOfCreation): self
   	{
   		$this->dateOfCreation = $dateOfCreation;
   
   		return $this;
   	}

	/**
	 * @return mixed
	 */
	public function getInfo()
   	{
   		return $this->info;
   	}

	/**
	 * @param mixed $info
	 */
	public function setInfo($info): void
   	{
   		$this->info = $info;
   	}

	public function getCover(): ?string
   	{
   		return $this->cover;
   	}

	public function setCover(?string $cover): void
   	{
   		$this->cover = $cover;
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

	/**
	 * @param mixed $album
	 */
	public function setAlbum($album): void
	{
		$this->album = $album;
	}

}
