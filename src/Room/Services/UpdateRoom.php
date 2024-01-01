<?php

namespace App\Room\Services;

use App\Room\Entity\Room;
use App\Room\ValueObject\RoomValueObject;
use Doctrine\ORM\EntityManagerInterface;

class UpdateRoom
{
    /**
     * @var EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(RoomValueObject $roomValueObject, Room $room) : void
    {
        $room->setDescription($roomValueObject->description ?? $room->getDescription());
        $room->setPrice($roomValueObject->price ?? $room->getPrice());
        $room->setStatus($roomValueObject->status ?? $room->getStatus());
        $this->entityManager->persist($room);
        $this->entityManager->flush();
    }
}