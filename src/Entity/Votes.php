<?php

namespace App\Entity;

use App\Repository\VotesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VotesRepository::class)
 */
class Votes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $NubStar;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="vote")
     */
    private $service;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="votes")
     */
    private $Iduser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNubStar(): ?int
    {
        return $this->NubStar;
    }

    public function setNubStar(int $NubStar): self
    {
        $this->NubStar = $NubStar;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->Iduser;
    }

    public function setIduser(?User $Iduser): self
    {
        $this->Iduser = $Iduser;

        return $this;
    }
}
