<?php

final class GenreRepository extends AbstractRepository{


    public function __construct(){
        
        parent::__construct();
    }


    public function fetchGenresByProductId($productId): array {

        $sql = 'SELECT * FROM genre 
            INNER JOIN product_genre ON genre.id = product_genre.id_genre 
            WHERE product_genre.id_product = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $productId);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $arrayData = [];

        foreach ($data as $genre) {
            $arrayData[] = GenreMapper::mapToObject($genre);
        }

        return $arrayData;

    }



}