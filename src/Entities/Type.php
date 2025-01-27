<?php

class Type{

    private int $id;
    private string $type_name;

    public function __construct(string $type_name, int $id = 0)
    {
        $this->id = $id;
        $this->type_name = $type_name;
        
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getTypeName(): string
    {
        return $this->type_name;
    }
}


?>