<?php


final class UserRepository
{

    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Creates a new user in the database
     */
    public function createUser(array $userData, bool $isProfessional = false)
    {
        //Insert into DB

        $sql = "INSERT INTO user (username, user_password, user_mail) VALUES (:username, :user_password, :user_mail)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $userData['username']);
        $stmt->bindParam(':user_password', $userData['user_password']);
        $stmt->bindParam(':user_mail', $userData['user_mail']);
        $stmt->execute();

        // Get id user of the new user
        $userId = $this->db->lastInsertId();

        $sqlDetails = "INSERT INTO user_details (id_user, firstName, lastName, country, address, phone) VALUES (:user_id, :first_name, :last_name, :pays, :adresse, :phone)";

        $stmt = $this->db->prepare($sqlDetails);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':first_name', $userData['firstName']);
        $stmt->bindParam(':last_name', $userData['lastName']);
        $stmt->bindParam(':pays', $userData['pays']);
        $stmt->bindParam(':adresse', $userData['adresse']);
        $stmt->bindParam(':phone', $userData['phone']);
        $stmt->execute();

        // Insert into professional_details if professional details were filled
        if ($isProfessional) {
            $sqlPro = "INSERT INTO professional_details (id_user, company_name, company_address, company_phone) VALUES (:user_id, :company_name, :company_address, :company_phone)";
            $stmt = $this->db->prepare($sqlPro);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':company_name', $userData['company_name']);
            $stmt->bindParam(':company_address', $userData['company_address']);
            $stmt->bindParam(':company_phone', $userData['company_phone']);
            $stmt->execute();
        }

    }


    /**
     * Checks if a mail is already used in the Database
     */
    public function isMailUsed(string $mail): bool
    {
        
        $sql = "SELECT * FROM user WHERE user_mail = :mail";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        return $user !== false;
    }
}
