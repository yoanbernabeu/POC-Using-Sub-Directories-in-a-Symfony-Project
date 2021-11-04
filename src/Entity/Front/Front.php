<?php

namespace App\Entity\Front;

use App\Repository\Front\FrontRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FrontRepository::class)
 */
class Front
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $front;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFront(): ?string
    {
        return $this->front;
    }

    public function setFront(string $front): self
    {
        $this->front = $front;

        return $this;
    }
}
