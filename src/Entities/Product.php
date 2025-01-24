<?php

class Product {
    
    private int $id;
    private string $name;
    private string $specifications;

    // ?

    private Image $image;
    private Author $author;
    private Type $type;
    private array $genres;
 
    public function __construct(string $name, string $specifications, int $id = 0){

        $this->name = $name;
        $this->specifications = $specifications;
        $this->id = $id;
    }

    /**
     * Get the value of image
     */ 
    public function getImage(): Image
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of genres
     */ 
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * Set the value of genres
     *
     * @return  self
     */ 
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Set the value of genres
     *
     * @return  self
     */ 
    public function addGenre(Genre $genre): self
    {

        $this->genres[] = $genre;

        return $this;
    }


}

?>