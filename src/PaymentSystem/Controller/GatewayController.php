<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


class GatewayController extends AbstractController
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

    #[Route('/pay', name: "Pay", methods: ["GET"])]
    public function Pay(EntityManagerInterface $entityManager, InitializePayment $initializePayment)
    {
        $response = [
            'status' => 200,
            'message' => "OK",
            'date' => date('Y-m-d H:i:s')
        ];
        $initializePayment->init();
    }
}