<?php

class Author{

    private int $id;
    private string $name;
    private string $biography;


    public function __construct(string $name, string $biography, int $id = 0){

        $this->name = $name;
        $this->biography = $biography;
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }


}

?>