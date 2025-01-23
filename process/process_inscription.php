<?php

require_once "../utils/autoloader.php";

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
        header("location: ../public/inscription.php?error=emptyfield&erroron={$form}");
        die();
    }
    
}

$isProfessional = false;
// Vérifier si les champs professionnels sont remplis
if (isset($_POST["isProfessional"]) && $_POST["isProfessional"] == "on"){

    foreach ($professionalFields as $field) {
        if (!isset($_POST[$form]) || empty($_POST[$form])) {
            header("location: ../public/inscription.php?error=emptyfield&erroron={$form}");
            die();
        }
    }

    $isProfessional = true;
}


// Vérifier mail

if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
    header("location: ../public/inscription.php?error=invalidmail");
    die();
}


// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["phone"])) {
    header("location: ../public/inscription.php?error=invalidphone");
    die();
}


// Sanitize
$userData = [];


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

    $userData += [
        'company_name' => $company_name,
        'company_address' => $company_address,
        'company_phone' => $company_phone
    ];

}

$userData += [
    'firstName' => $firstName,
    'lastName' => $lastName,
    'username' => $username,
    'user_mail' => $user_mail,
    'pays' => $pays,
    'adresse' => $adresse,
    'phone' => $phone
];



// Vérifier si les deux password sont identiques.

if ($user_password !== $confirmpassword) {
    header("location: ../public/inscription.php?error=passwordsdontmatch");
    die();
}




// Vérifier si mail n'est pas déja pris par un autre utilisateur

$userRepo = new UserRepository();



if ($userRepo->isMailUsed($user_mail) == true)
{
    header("location: ../public/inscription.php?error=mailtaken");
    die();
};


// TODO : Vérifier si le mot de passe est assez fort 

// Hash password


$hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);

$userData += [
    'user_password' => $hashedPassword
];


$userRepo->createUser($userData, $isProfessional);




header("location: ../public/login.php?success=inscription");


?>