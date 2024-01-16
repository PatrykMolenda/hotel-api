<?php

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Payment;

class InitializePayment
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // TODO: Implement Payment Value Object
    public function init(PaymentValueObject $paymentObject)
    {
        $payment = new Payment();
        $payment->setDescription($paymentObject->getDescription());
        $payment->setPrice($paymentObject->getPrice());
        $payment->setStatus($paymentObject->getStatus());
        $this->entityManager->persist($payment);
        $this->entityManager->flush();
    }
}