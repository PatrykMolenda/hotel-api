<?php


#[ORM\Entity()]
#[ORM\Table(name:"payments")]
#[ORM\HasLifecycleCallbacks]
class Payment
{
    use IdTrait;

    #[ORM\Column(name: "status", type: "integer")]
    private int $status;

    #[ORM\Column(name: "title", type: "string", length: 128)]
    private string $title;

    #[ORM\Column(name: "value", type: "integer")]
    private int $value;

    public function getStatus() : int
    {
        return $this->status;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getValue() : int
    {
        return $this->value;
    }

    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function setValue(int $value) : void
    {
        $this->value = $value;
    }

    
}