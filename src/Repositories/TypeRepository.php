<?php

final class TypeRepository extends AbstractRepository{


    public function __construct(){
        
        parent::__construct();
    }


    public function fetchById($typeId): ?Type {

        $sql = 'SELECT * FROM type WHERE id = :id';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $typeId);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);



        return TypeMapper::mapToObject($data);

    }



}

?>