<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
	#[ORM\Id]
            	#[ORM\GeneratedValue]
            	#[ORM\Column(type: 'integer')]
            	private $id;

	#[ORM\Column(type: 'string', length: 255)]
            	private $name;

	#[ORM\OneToMany(mappedBy: "country", targetEntity: Group::class)]
            	private $group;

	#[ORM\OneToMany(mappedBy: "country", targetEntity: Performer::class)]
            	private $performer;

	public function __construct()
            	{
            		$this->group = new ArrayCollection();
              $this->performer = new ArrayCollection();
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

	public function getGroup(): ?Group
            	{
            		return $this->group;
            	}

	public function setGroup(?Group $group): self
            	{
            		$this->group = $group;
            
            		return $this;
            	}

	public function addGroup(Group $group): self
            	{
            		if (!$this->group->contains($group))
            		{
            			$this->group[] = $group;
            			$group->setCountry($this);
            		}
            
            		return $this;
            	}

	public function removeGroup(Group $group): self
            	{
            		if ($this->group->removeElement($group))
            		{
            			// set the owning side to null (unless already changed)
            			if ($group->getCountry() === $this)
            			{
            				$group->setCountry(null);
            			}
            		}
            
            		return $this;
            	}

	public function __toString()
            	{
            		return $this->name;
            	}

    /**
     * @return Collection<int, Performer>
     */
    public function getPerformer(): Collection
    {
        return $this->performer;
    }

    public function addPerformer(Performer $performer): self
    {
        if (!$this->performer->contains($performer)) {
            $this->performer[] = $performer;
            $performer->setCountry($this);
        }

        return $this;
    }

    public function removePerformer(Performer $performer): self
    {
        if ($this->performer->removeElement($performer)) {
            // set the owning side to null (unless already changed)
            if ($performer->getCountry() === $this) {
                $performer->setCountry(null);
            }
        }

        return $this;
    }
}
