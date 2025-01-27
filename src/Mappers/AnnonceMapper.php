<?php

class AnnonceMapper{
    public static function mapToObject(array $data, Product $product, User $user, array $images): Annonce{
        $annonce = new Annonce(
            $data['price'],
            $data['condition'],
            $data['id'],
        );

        $annonce->setProduct($product);

        $annonce->setUser($user);

        $annonce->setImages($images);

        return $annonce;
    }
}

?>