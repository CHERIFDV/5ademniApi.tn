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
}
