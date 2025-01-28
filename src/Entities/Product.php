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
 
    public function __construct(string $name, string $specifications = "Aucune spécification", int $id = 0){

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

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpecifications(): string
    {
        return $this->specifications;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): Author
    {
        return $this->author;
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
    public function setGenres(array $genres)
    {

        // Check if array given has instances of genre

        foreach($genres as $genre){
            if(!$genre instanceof Genre){
                throw new Exception('Invalid genre');
            }
        }


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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


}

?>