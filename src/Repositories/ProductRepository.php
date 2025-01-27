<?php

final class ProductRepository extends AbstractRepository{

    public function __construct(){

    parent::__construct();        
    }

    public function fetchProductById($productId) {

        $sql = 'SELECT * FROM product WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $productId);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // fetch Image
        $imageRepo = new ImageRepository($this->db);
        $image = $imageRepo->getImageById($data['id_image']);

        $typeRepo = new TypeRepository($this->db);
        $type = $typeRepo->fetchById($data['id_type']);

        $authorRepo = new AuthorRepository($this->db);
        $author = $authorRepo->fetchById($data['id_author']);
        

        $genreRepo = new GenreRepository($this->db);
        $genres = $genreRepo->fetchGenresByProductId($data['id']);
        





        return ProductMapper::mapToObject($data, $image, $author, $type, $genres);
    }

    public function searchProductsByName($query): array {

        $sql = "SELECT product.*, author.name as author_name 
            FROM product 
            JOIN author ON product.id_author = author.id 
            WHERE product.name LIKE :query";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":query" => '%' . $query . '%']);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }


}

?>