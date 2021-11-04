<?php

namespace App\Entity\Back;

use App\Repository\Back\BackRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BackRepository::class)
 */
class Back
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
    private $back;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBack(): ?string
    {
        return $this->back;
    }

    public function setBack(string $back): self
    {
        $this->back = $back;

        return $this;
    }
}
