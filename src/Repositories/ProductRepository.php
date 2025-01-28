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

    public function fetchProductByName(string $productname): ?Product{
        
        $sql = "SELECT * FROM product WHERE name = :name";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([":name" => $productname]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product ?? null;
    }

    /**
     * Create a new product in DB
     */
    public function createProduct(Product $product) {

        $sql = 'INSERT INTO product (name, id_author, id_type, id_image) VALUES (:name, :id_author, :id_type, :id_image)';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $product->getName());
        $stmt->bindParam(':id_author', $product->getAuthor()->getId());
        $stmt->bindParam(':id_type', $product->getType()->getId());
        $stmt->bindParam(':id_image', $product->getImage()->getId());

        $stmt->execute();

        $product->setId($this->db->lastInsertId());

        // Insert genres
        foreach ($product->getGenres() as $genre) {

            $genreName = $genre->getName();
            // Check if genre exists
            $sql = 'SELECT id FROM genre WHERE name = :name';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $genreName);
            $stmt->execute();
            $genreId = $stmt->fetchColumn();

            // If genre does not exist, create it
            if (!$genreId) {
            $sql = 'INSERT INTO genre (name) VALUES (:name)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $genreName);
            $stmt->execute();
            $genreId = $this->db->lastInsertId();
            }

            // Insert into product_genre
            $sql = 'INSERT INTO product_genre (product_id, genre_id) 
                SELECT :product_id, :genre_id 
                WHERE NOT EXISTS (
                SELECT 1 FROM product_genre 
                WHERE product_id = :product_id AND genre_id = :genre_id
                )';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':product_id', $product->getId());
            $stmt->bindParam(':genre_id', $genreId);
            $stmt->execute();
        }

    }


}

?>