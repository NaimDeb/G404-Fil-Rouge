<?php

class Type{

    private int $id;
    private string $type_name;

    public function __construct(int $id, string $type_name)
    {
        $this->id = $id;
        $this->type_name = $type_name;
        
    }
}


?>