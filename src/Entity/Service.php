<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity=Photos::class, mappedBy="service")
     */
    private $Photos;

    /**
     * @ORM\OneToMany(targetEntity=Votes::class, mappedBy="service")
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="services")
     */
    private $Owner;

    /**
     * @ORM\ManyToMany(targetEntity=Categorys::class, inversedBy="services")
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="ForService")
     */
    private $comments;

    public function __construct()
    {
        $this->Photos = new ArrayCollection();
        $this->vote = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getPhotos(): Collection
    {
        return $this->Photos;
    }

    public function addPhoto(Photos $photo): self
    {
        if (!$this->Photos->contains($photo)) {
            $this->Photos[] = $photo;
            $photo->setService($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): self
    {
        if ($this->Photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getService() === $this) {
                $photo->setService(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Votes>
     */
    public function getVote(): Collection
    {
        return $this->vote;
    }

    public function addVote(Votes $vote): self
    {
        if (!$this->vote->contains($vote)) {
            $this->vote[] = $vote;
            $vote->setService($this);
        }

        return $this;
    }

    public function removeVote(Votes $vote): self
    {
        if ($this->vote->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getService() === $this) {
                $vote->setService(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->Owner;
    }

    public function setOwner(?User $Owner): self
    {
        $this->Owner = $Owner;

        return $this;
    }

    /**
     * @return Collection<int, Categorys>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Categorys $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorys $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setForService($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getForService() === $this) {
                $comment->setForService(null);
            }
        }

        return $this;
    }
}
