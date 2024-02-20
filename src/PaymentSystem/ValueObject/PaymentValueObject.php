<?php

class PaymentValueObject
{
    public string $description;
    public int $price;
    public string $status;

    /**
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice() : int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getStatus() : string
    {
        return $this->status;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * @param int $price
     * @return void
     */
    public function setPrice(int $price) : void
    {
        $this->price = $price;
    }

    /**
     * @param string $status
     * @return void
     */
    public ufnction setStatus(string $status) : void
    {
        $this->status = $status;
    }
}