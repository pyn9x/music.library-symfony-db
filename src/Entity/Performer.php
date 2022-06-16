<?php

namespace App\Entity;

use App\Repository\PerformerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PerformerRepository::class)]
class Performer
{
	#[ORM\Id]
            	#[ORM\GeneratedValue]
            	#[ORM\Column(type: 'integer')]
            	private $id;

	#[ORM\Column(type: 'string', length: 255)]
            	private $surname;

	#[ORM\Column(type: 'string', length: 255)]
            	private $name;

	#[ORM\Column(type: 'date')]
            	private $birthday;

	#[ORM\Column(type: 'date', nullable: true)]
            	private $deathday;

	#[ORM\ManyToMany(targetEntity: Role::class, inversedBy: "performer")]
            	private $role;

	#[ORM\ManyToMany(targetEntity: Group::class, mappedBy: "performer")]
            	private $group;

	#[ORM\ManyToMany(targetEntity: Song::class, mappedBy: "performer")]
            	private $song;

	#[ORM\ManyToOne(targetEntity: Country::class, inversedBy: "performer")]
            	private $country;

	#[ORM\Column(nullable: true)]
            	protected ?string $cover;

	public function __construct()
            	{
            		$this->role = new ArrayCollection();
            		$this->group = new ArrayCollection();
              $this->song = new ArrayCollection();
            	}

	public function __toString()
            	{
            		return $this->name;
            	}

	public function getId(): ?int
            	{
            		return $this->id;
            	}

	public function getsurname(): ?string
            	{
            		return $this->surname;
            	}

	public function setsurname(string $surname): self
            	{
            		$this->surname = $surname;
            
            		return $this;
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

	public function getBirthday(): ?\DateTimeInterface
            	{
            		return $this->birthday;
            	}

	public function setBirthday(\DateTimeInterface $birthday): self
            	{
            		$this->birthday = $birthday;
            
            		return $this;
            	}

	public function getDeathday(): ?\DateTimeInterface
            	{
            		return $this->deathday;
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

	public function setDeathday(\DateTimeInterface $deathday): self
            	{
            		$this->deathday = $deathday;
            
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

	/**
	 * @return Collection<int, Role>
	 */
	public function getRole(): Collection
            	{
            		return $this->role;
            	}

	public function addRole(Role $role): self
            	{
            		if (!$this->role->contains($role))
            		{
            			$this->role[] = $role;
            		}
            
            		return $this;
            	}

	public function removeRole(Role $role): self
            	{
            		$this->role->removeElement($role);
            
            		return $this;
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
            			$group->addPerformer($this);
            		}
            
            		return $this;
            	}

	public function removeGroup(Group $group): self
            	{
            		if ($this->group->removeElement($group))
            		{
            			$group->removePerformer($this);
            		}
            
            		return $this;
            	}

	public function getCountry(): ?Country
            	{
            		return $this->country;
            	}

	public function setCountry(?Country $country): self
            	{
            		$this->country = $country;
            
            		return $this;
            	}

    /**
     * @return Collection<int, Song>
     */
    public function getSong(): Collection
    {
        return $this->song;
    }

    public function addSong(Song $song): self
    {
        if (!$this->song->contains($song)) {
            $this->song[] = $song;
            $song->addPerformer($this);
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->song->removeElement($song)) {
            $song->removePerformer($this);
        }

        return $this;
    }
}
