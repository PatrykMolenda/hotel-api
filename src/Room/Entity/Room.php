<?php

namespace App\Room\Entity;

use App\Core\Entity\TraitSpace\IdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"rooms")]
#[ORM\HasLifecycleCallbacks]
class Room
{
    use IdTrait;

    #[ORM\Column(name: "status", type: "integer")]
    private int $status;

    #[ORM\Column(name: "description", type: "string", length: 512)]
    private string $description;

    #[ORM\Column(name: "price", type: "integer")]
    private int $price;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}