<?php

namespace App\Entity;

use App\Repository\SongRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $duration;

	#[ORM\Column(type: 'date', nullable: true)]
                  	private $release_date;

    #[ORM\ManyToMany(targetEntity: Album::class, inversedBy: 'songs')]
    private $album;

	#[ORM\ManyToMany(targetEntity: Performer::class, inversedBy: 'songs')]
                private $author;

    public function __construct()
    {
        $this->album = new ArrayCollection();
        $this->author = new ArrayCollection();
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

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration): self
    {
        $this->duration = $duration;

        return $this;
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
        if (!$this->album->contains($album)) {
            $this->album[] = $album;
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        $this->album->removeElement($album);

        return $this;
    }

	public function __toString()
                  	{
                  		return $this->name;
                  	}

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * @return Collection<int, Performer>
     */
    public function getAuthor(): Collection
    {
        return $this->author;
    }

    public function addAuthor(Performer $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Performer $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }
}
