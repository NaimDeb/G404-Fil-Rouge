<?php

class UserDetailsRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserDetailsByUserId($id)
    {
        $sql = "SELECT id, id_user, address, phone, country, firstName, lastName FROM user_details WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);


        return UserDetailsMapper::mapToObject($data);
    }


    public function createUserDetails(array $userData, int $userId)
    {
        $sql = "INSERT INTO user_details (id_user, address, phone, country, firstName, lastName) VALUES (:id_user, :address, :phone, :country, :firstName, :lastName)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id_user' => $userId,
            ':address' => $userData["adresse"],
            ':phone' => $userData["phone"],
            ':country' => $userData["pays"],
            ':firstName' => $userData["firstName"],
            ':lastName' => $userData["lastName"]
        ]);
    }
}
?>