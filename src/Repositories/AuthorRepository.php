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



}