<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

	#[ORM\ManyToMany(targetEntity: Performer::class, mappedBy: "role")]
                     	private $performer;

    public function __construct()
    {
        $this->performer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

	public function __toString()
	{
		return $this->name;
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
            $performer->addRole($this);
        }

        return $this;
    }

    public function removePerformer(Performer $performer): self
    {
        if ($this->performer->removeElement($performer)) {
            $performer->removeRole($this);
        }

        return $this;
    }
}
