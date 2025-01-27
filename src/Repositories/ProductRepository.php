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

        return ProductMapper::mapToObject($data);
    }


}

?>