<?php

namespace App\Room\Controller;

use App\Room\Entity\Room;
use App\Room\Services\CreateRoom;
use App\Room\Services\UpdateRoom;
use App\Room\ValueObject\RoomValueObject;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class APIController extends AbstractController
{

    public function error(\Throwable $exception): Response
    {
        $response = [
            'status' => 400,
            "message" => $exception->getMessage(),
            "date" => date('Y-m-d H:i:s'),
        ];
        return $this->json($response);
    }

    #[Route('/rooms', name: "HotelRooms", methods: ["GET"])]
    public function HotelRoom(EntityManagerInterface $entityManager) : JsonResponse
    {
        $rooms = $entityManager->getRepository(Room::class)->findAll();
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        $response['content'] = $rooms;


        return $this->json($response);
    }

    #[Route('/room/{id}', name: "HotelRoomData", methods: ["GET"])]
    public function HotelRoomData(EntityManagerInterface $entityManager, mixed $id)
    {
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        if(intval($id) === 0 && $id !== "0") {
            $response['status'] = 403;
            $response['message'] = "Forbidden";
            return $this->json($response);
        }
        $room = $entityManager->getRepository(Room::class)->findBy([
            'id' => $id
        ]);
        if(!$room) {
            $response['status'] = 404;
            $response['message'] = "Room not found!";
            return $this->json($response);
        }
        $room = $room[0];
        $response['content'] = [
            [
                'id' => $room->getId(),
                'status' => $room->getStatus(),
                'description' => $room->getDescription(),
                'price' => $room->getPrice()
            ]
        ];


        return $this->json($response);
    }

    #[Route('/rooms/{filter}', name: "HotelStatusFilter", methods: ["GET"])]
    public function HotelRoomFilter(EntityManagerInterface $entityManager, mixed $filter) : JsonResponse
    {
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        if(!$this->validFilter($filter)) {
            $response['status'] = 403;
            $response["message"] = "Forbidden";
            return $this->json($response);
        }
        $rooms = $entityManager->getRepository(Room::class)->findBy([
            'status' => $filter
        ]);

        $response['content'] = $rooms;


        return $this->json($response);
    }

    #[Route('/rooms', name: "HotelCreateRoom", methods: ["POST"])]
    public function HotelCreateRoom(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        $description = $request->get("description");
        $price = $request->get('price');
        if(!$this->validCreate($description, $price)) {
            $response["status"] = 403;
            $response["message"] = "Forbidden";
            return $this->json($response);
        }
        $roomValueObject = new RoomValueObject();
        $roomValueObject->description = $description;
        $roomValueObject->price = intval($price);
        $roomValueObject->status = 1;
        $createRoom = new CreateRoom($entityManager);
        $createRoom->create($roomValueObject);
        return $this->json($response);
    }

    #[Route('/rooms/{id}', name:"HotelRoomDelete", methods: ["DELETE"])]
    public function HotelRoomDelete(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        $room = $entityManager->getRepository(Room::class)->findBy([
            'id' => $id
        ]);
        if(!$room) {
            $response['status'] = 404;
            $response['message'] = "Room not found!";
            return $this->json($response);
        }
        $room = $room[0];
        $entityManager->remove($room);
        $entityManager->flush();
        return $this->json($response);
    }

    #[Route('/rooms/{id}', name: "HotelRoomUpdate", methods: ["PATCH"])]
    public function HotelRoomUpdate(EntityManagerInterface $entityManager, Request $request, int $id) : JsonResponse
    {
        $response = [
            'status' => 200,
            "message" => "OK",
            "date" => date('Y-m-d H:i:s'),
        ];
        $room = $entityManager->getRepository(Room::class)->findBy([
            'id' => $id
        ]);
        if(!$room) {
            $response['status'] = 404;
            $response['message'] = "Room not found!";
            return $this->json($response);
        }
        $roomValueObject = new RoomValueObject();
        if($request->get('description', false)) {
            $roomValueObject->description = $request->get('description', null);
        }
        if($request->get('price', false)) {
            $roomValueObject->price = $request->get('price', null);
        }
        if($request->get('status', false)) {
            $roomValueObject->status = $request->get('status', null);
        }
        $updateRoom = new UpdateRoom($entityManager);
        $updateRoom->update($roomValueObject, $room[0]);
        return $this->json($response);
    }

    /**
     * @param mixed $description
     * @param mixed $price
     * @return bool
     */
    protected function validCreate(mixed $description, mixed $price) : bool
    {
        if(gettype($description) != 'string' or (intval($price) === 0 && $price !== "0")) {
            return false;
        }
        return true;
    }

    /**
     * @param mixed $filter
     * @return bool
     */
    protected function validFilter(mixed $filter) : bool
    {
        if($filter != 1 and $filter != 0) {
            return false;
        }
        return true;
    }
}