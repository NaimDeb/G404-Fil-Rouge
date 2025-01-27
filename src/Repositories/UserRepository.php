<?php


final class UserRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Creates a new user in the database, calls UserDetailsRepo and ProDetailsRepo to create the details too.
     */
    public function createUser(array $userData, bool $isProfessional = false): void
    {
        //Insert into DB

        $sql = "INSERT INTO user (username, user_password, user_mail) VALUES (:username, :user_password, :user_mail)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $userData['username']);
        $stmt->bindParam(':user_password', $userData['user_password']);
        $stmt->bindParam(':user_mail', $userData['user_mail']);
        $stmt->execute();

        $userId = $this->db->lastInsertId();


        // User details
        $UserDetailsRepo = new UserDetailsRepository;

        $UserDetailsRepo->createUserDetails($userData, $userId);

        // Professional details
        if ($isProfessional)
        {
            $proDetailsRepo = new ProfessionalDetailsRepository;
            $proDetailsRepo->createProfessionalDetails($userData, $userId);
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

    /**
     * Fetch user by mail OR username and returns a instanciated User or Professional object
     */
    public function fetchUserByMailOrUsername(string $input): ?User
    {
        $sql = "SELECT * FROM user WHERE user_mail = :input OR username = :input";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':input', $input);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($data) === 0) {
            return null;
        }

        $user = UserMapper::mapToObject($data);


        return $user;


    }


    public function fetchUserById(int $userId): ?User {
        $sql = "SELECT * FROM user WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (count($data) === 0) {
            return null;
        }

        $user = UserMapper::mapToObject($data);

        return $user;
    }







    



    public function checkUserPassword(int $userId, string $password): bool
    {
        $sql = "SELECT user_password FROM user WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return password_verify($password, $user['user_password']);

    }

    public function updatePassword(int $userId, string $hashedPassword)
    {
        $sql = "UPDATE user SET user_password = :password WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function updateUser(array $userData, int $userId)
    {
        $sql = "UPDATE user SET username = :username, user_mail = :user_mail WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $userData["username"]);
        $stmt->bindParam(':user_mail', $userData["user_mail"]);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }



    public function updateProfileDescription(string $desc, int $userId)
    {
        $sql = "UPDATE user SET profile_desc = :desc WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
    }

    public function updateProfilePicture(int $userId, string $fileName)
    {
        $sql = "INSERT INTO image (img_path) VALUES (:image_path)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':image_path' => $fileName
        ]);

        $idImage = $this->db->lastInsertId();

        $sql = "UPDATE user SET id_image = :id_image WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_image' => $idImage,
            ':id' => $userId
        ]);
    }


    public function getImageOfUser(int $userId): Image
    {
        $sql = "SELECT id, img_path FROM image WHERE id = (SELECT id_image FROM user WHERE id = :id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);



        return $data ? ImageMapper::mapToObject($data) : new Image(1, "default.jpg") ;
    }



}
