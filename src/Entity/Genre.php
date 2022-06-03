<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

	#[ORM\ManyToMany(targetEntity: Group::class, mappedBy:"Genre")]
	private $group;

	public function __construct()
	{
		$this->group = new ArrayCollection();
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
	public function getGroup():Collection
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

	public function __toString(){
		return $this->name;
	}
}
