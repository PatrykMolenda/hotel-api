<?php

namespace App\Room\Services;

use App\Room\Entity\Room;
use App\Room\ValueObject\RoomValueObject;
use Doctrine\ORM\EntityManagerInterface;

class CreateRoom
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(RoomValueObject $roomValueObject) : void
    {
        $room = new Room();
        $room->setPrice($roomValueObject->price);
        $room->setDescription($roomValueObject->description);
        $room->setStatus($roomValueObject->status);
        $this->entityManager->persist($room);
        $this->entityManager->flush();
    }
}