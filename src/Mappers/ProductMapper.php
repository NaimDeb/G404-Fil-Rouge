<?php

class ProductMapper {


    public static function mapToObject(array $data, Image $image, Author $author, Type $type, array $genres): Product
    {
        $product = new Product(
            $data['name'],
            $data['specifications'],
            $data['id'],
        );

        $product->setImage($image);

        $product->setAuthor($author);

        $product->setType($type);

        $product->setGenres($genres);

        return $product;
    }

}


?>