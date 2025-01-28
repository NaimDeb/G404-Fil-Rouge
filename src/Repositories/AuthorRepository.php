<?php

final class AuthorRepository extends AbstractRepository{


    public function __construct(){
        
        parent::__construct();
    }


    public function fetchById($authorId) {

        $sql = 'SELECT * FROM author WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $authorId);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return AuthorMapper::mapToObject($data);

    }

    public function createAuthor(Author $author) {

        $sql = 'INSERT INTO author (name) VALUES (:name)';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $author->getName());

        $stmt->execute();

        $author->setId($this->db->lastInsertId());

        return $author;
    }

    public function fetchByName(int $authorName): ?Author{
        
        $sql = "SELECT * FROM author WHERE name = :name";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $authorName);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return AuthorMapper::mapToObject($data);
    }



}