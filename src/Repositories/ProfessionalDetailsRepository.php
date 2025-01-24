<?php

class ProfessionalDetailsRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProDetailsByUserId($id): ?ProfessionalDetails
    {
        $sql = "SELECT id, id_user, company_address, company_phone, company_name FROM professional_details WHERE id_user = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $data =  $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return ProfessionalDetailsMapper::mapToObject($data);
    }


    public function createProfessionalDetails(array $proData, int $userId)
    {
        $sql = "INSERT INTO professional_details (id_user, company_name, company_address, company_phone) VALUES (:id_user, :company_name, :company_address, :company_phone)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id_user' => $userId,
            ':company_name' => $proData["company_name"],
            ':company_address' => $proData["company_address"],
            ':company_phone' => $proData["company_phone"]
        ]);
    }


    public function updateProfessionalDetails(array $data, int $userId){

        $sql = "UPDATE professional_details SET company_name = :company_name, company_address = :company_address, company_phone = :company_phone WHERE id_user = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':company_name', $data["company_name"]);
        $stmt->bindParam(':company_address', $data["company_address"]);
        $stmt->bindParam(':company_phone', $data["company_phone"]);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }
}
?>