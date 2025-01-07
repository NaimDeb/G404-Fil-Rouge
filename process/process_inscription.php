<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BookMarket/globals.php';


$formFields = [
    'firstName',        // Prénom
    'lastName',         // Nom
    'username',         // Nom d'utilisateur
    'user_mail',        // Adresse email
    'user_password',    // Mot de passe
    'confirmpassword',  // Confirmer le mot de passe
    'pays',             // Pays
    'adresse',          // Adresse 
    'phone',            // Numéro de téléphone 
    
];

$professionalFields = [
    'company_name',     // Nom de l'entreprise
    'company_address',  // Adresse de l'entreprise
    'company_phone'     // Numéro de téléphone de l'entreprise
];

foreach ($formFields as $form) {

    if (!isset($_POST[$form]) || empty($_POST[$form])) {
        header("location: ../public/pages/inscription.php?error=emptyfield&erroron={$form}");
        die();
    }
    
}

$isProfessional = false;
// Vérifier si les champs professionnels sont remplis
if (isset($_POST["isProfessional"]) && $_POST["isProfessional"] == "on"){

    foreach ($professionalFields as $field) {
        if (!isset($_POST[$form]) || empty($_POST[$form])) {
            header("location: ../public/pages/inscription.php?error=emptyfield&erroron={$form}");
            die();
        }
    }

    $isProfessional = true;
}


// Vérifier mail

if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
    header("location: ../public/pages/inscription.php?error=invalidmail");
    die();
}


// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["phone"])) {
    header("location: ../public/pages/inscription.php?error=invalidphone");
    die();
}


// Sanitize

$firstName = htmlspecialchars(trim($_POST["firstName"]));
$lastName = htmlspecialchars(trim($_POST["lastName"]));
$username = htmlspecialchars(trim($_POST["username"]));
$user_mail = htmlspecialchars(trim($_POST["user_mail"]));
$user_password = htmlspecialchars(trim($_POST["user_password"]));
$confirmpassword = htmlspecialchars(trim($_POST["confirmpassword"]));
$pays = htmlspecialchars(trim($_POST["pays"]));
$adresse = htmlspecialchars(trim($_POST["adresse"]));
$phone = htmlspecialchars(trim($_POST["phone"]));

if ($isProfessional) {

    $company_name = htmlspecialchars(trim($_POST["company_name"]));
    $company_address = htmlspecialchars(trim($_POST["company_address"]));
    $company_phone = htmlspecialchars(trim($_POST["company_phone"]));

}



// Vérifier si mail existe

require_once "../utils/connectDB.php";

$stmt = $pdo->prepare("SELECT * FROM user WHERE user_mail = ?");
$stmt->execute([$user_mail]);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (count($users) > 0){
    header("location: ../public/pages/inscription.php?error=mailtaken");
    die();
};

// Vérifier si les deux password sont identiques.

if ($user_password !== $confirmpassword) {
    header("location: ../public/pages/inscription.php?error=passwordsdontmatch");
    die();
}

// TODO : Vérifier si le mot de passe est assez fort 

// Hash password


$hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);



//Insert into DB

$sql = "INSERT INTO user (username, user_password, user_mail) VALUES (:username, :user_password, :user_mail)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':username' => $username,
    ':user_password' => $hashedPassword,
    ':user_mail' => $user_mail
]);

// Get id user of the new user
$userId = $pdo->lastInsertId();


$sqlDetails = "INSERT INTO user_details (id_user, firstName, lastName, country, address, phone) VALUES (:user_id, :first_name, :last_name, :pays, :adresse, :phone)";
$stmt = $pdo->prepare($sqlDetails);
$stmt->execute([
    ':user_id' => $userId,
    ':first_name' => $firstName,
    ':last_name' => $lastName,
    ':pays' => $pays,
    ':adresse' => $adresse,
    ':phone' => $phone
]);



// Insert into professional_details if professional details were filled

if ($isProfessional) {

    $sqlPro = "INSERT INTO professional_details (id_user, company_name, company_address, company_phone) VALUES (:user_id, :company_name, :company_address, :company_phone)";
    $stmt = $pdo->prepare($sqlPro);
    $stmt->execute([
        ':user_id' => $userId,
        ':company_name' => $company_name,
        ':company_address' => $company_address,
        ':company_phone' => $company_phone
    ]);

}


header("location: ../public/pages/login.php?success=inscription");


?>