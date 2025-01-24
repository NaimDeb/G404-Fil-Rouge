<?php

class ProductMapper {


    public static function mapToObject(array $data)
    {
        $product = new Product(
            $data['name'],
            $data['specifications'],
            $data['id'],
        );

        return $product;
    }

}


?>