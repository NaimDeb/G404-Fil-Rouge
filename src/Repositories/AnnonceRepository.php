<?php

final class AnnonceRepository extends AbstractRepository{


    public function __construct(){
        
        parent::__construct();
    }


    public function fetchAnnonceById($annonceId) {

        $sql = 'SELECT * FROM annonce WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $annonceId);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);


        // Calls UserRepository to fetch the user who created the ad

        $userId = $data['id_user'];

        $userRepo = new UserRepository;

        $user = $userRepo->fetchUserById($userId);

        // Calls ProductRepository to fetch the product linked to the ad

        $productId = $data['id_product'];

        $productRepo = new ProductRepository;

        $product = $productRepo->fetchProductById($productId);

        // Calls ImageRepository to fetch all the images linked to the ad

        $imageRepo = new ImageRepository;

        $images = $imageRepo->fetchImagesByAnnonceId($annonceId);

        // Instanciate the Annonce object

        $annonce = AnnonceMapper::mapToObject($data, $product, $user, $images);

        return $annonce;

    }



}

?>