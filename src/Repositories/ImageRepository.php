<?php

final class ImageRepository extends AbstractRepository{


    public function __construct(){

        parent::__construct();
    }

    public function getImageById($id){
        $sql = "SELECT id, img_path FROM image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return ImageMapper::mapToObject($data);
    }

    public function getDefaultUserImage(){
        $sql = "SELECT id, img_path FROM image WHERE id = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return ImageMapper::mapToObject($data);
    }

    public function createImage(string $fileName){
        $sql = "INSERT INTO image (img_path) VALUES (:image_path)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':image_path' => $fileName
        ]);

        return $this->db->lastInsertId();

        
    }

    public function fetchImagesByAnnonceId(int $annonceId): array{

        $sql = "SELECT image.id, image.img_path FROM image JOIN image_annonce ON image.id = image_annonce.id_image WHERE image_annonce.id_annonce = :id_annonce;";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_annonce', $annonceId);

        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $images = [];

        foreach ($data as $image) {
            $images[] = ImageMapper::mapToObject($image);
        }

        return $images;

    }


}