<?php

namespace App\Core\Entity\TraitSpace;

use Doctrine\ORM\Mapping as ORM;

trait IdTrait
{
    #[ORM\Id]
    #[ORM\Column(name: "id",  type: "integer")]
    #[ORM\GeneratedValue()]
    private int $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}