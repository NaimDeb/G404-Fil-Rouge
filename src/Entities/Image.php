<?php

class Image {

    private int $id;
    private string $imgPath;
    private string $imgAlt;


    public function __construct($imgPath,int $id = 0, $imgAlt = "Template image")
    {
        $this->imgPath = $imgPath;
        $this->id = $id;
        $this->imgAlt = $imgAlt;

    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of imgPath
     */ 
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Get the value of imgAlt
     */ 
    public function getImgAlt()
    {
        return $this->imgAlt;
    }
}

?>