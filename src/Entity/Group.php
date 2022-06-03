<?php

namespace App\Entity;

use App\Repository\GroupRepository;
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

	#[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: "Group")]
	private $genre;

	public function __construct()
	{
		$this->genre = new ArrayCollection();
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
	public function getGenre():Collection
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
		if (!$this->cover) {
			return null;
		}
		if (str_contains($this->cover, '/')) {
			return $this->cover;
		}
		return sprintf('/uploads/avatars/%s', $this->cover);
	}

	public function __toString(){
		return $this->name;
	}

}
