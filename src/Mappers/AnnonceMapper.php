<?php

class AnnonceMapper{
    public static function mapToObject(array $data){
        $annonce = new Annonce(
            $data['price'],
            $data['condition'],
            $data['id'],
        );

        return $annonce;
    }
}

?>