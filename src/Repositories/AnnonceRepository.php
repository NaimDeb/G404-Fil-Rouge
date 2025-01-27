<?php

final class AnnonceRepository extends AbstractRepository
{


    public function __construct()
    {

        parent::__construct();
    }

    public function getAnnonces($nbOfAnnonces) {

        $sql = 'SELECT * FROM annonce ORDER BY id DESC LIMIT :nbOfAnnonces';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':nbOfAnnonces', $nbOfAnnonces, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $annonces = [];

        foreach ($data as $annonce) {

            $classData = $this->getInstances($annonce['id_user'], $annonce['id_product'], $annonce['id']);

            $annonce = AnnonceMapper::mapToObject($annonce, $classData["product"], $classData["user"], $classData["images"]);

            $annonces[] = $annonce;
        }

        return $annonces;


    }


    public function fetchAnnonceById($annonceId)
    {

        $sql = 'SELECT * FROM annonce WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $annonceId);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);




        $classData = $this->getInstances($data['id_user'], $data['id_product'], $data['id']);

        $annonce = AnnonceMapper::mapToObject($data, $classData["product"], $classData["user"], $classData["images"]);

        return $annonce;
    }

    /**
     * Calls UserRepository to fetch the user who created the ad
     * Calls ProductRepository to fetch the product linked to the ad
     * Calls ImageRepository to fetch all the images linked to the ad
     */
    public function getInstances(int $userId, int $productId, int $annonceId): array
    {

        $userRepo = new UserRepository;
        $imageRepo = new ImageRepository;
        $productRepo = new ProductRepository;


        // Calls UserRepository to fetch the user who created the ad

        $user = $userRepo->fetchUserById($userId);

        // Calls ImageRepository to fetch all the images linked to the ad

        $images = $imageRepo->fetchImagesByAnnonceId($annonceId);

        // Calls ProductRepository to fetch the product linked to the ad

        $product = $productRepo->fetchProductById($productId);


        return [
            "user" => $user,
            "product" => $product,
            "images" => $images
        ];
    }
}
