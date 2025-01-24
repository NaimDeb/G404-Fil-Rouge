<?php

class ImageRepository extends AbstractRepository{


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


}