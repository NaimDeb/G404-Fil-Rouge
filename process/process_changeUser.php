<?php
require_once "../utils/autoloader.php";
require_once "./process_sanitization.php";
session_start();

$user_details = ["user_mail", "username"];

// Check if user wants to change password
// old_password new_password confirm_password
$isUserChangePassword = false;

if (!empty($_POST["old_password"]) || !empty($_POST["new_password"]) || !empty($_POST["confirm_password"])) {
    $isUserChangePassword = true;
    $user_details = ["user_mail", "username", "old_password", "new_password", "confirm_password"];
};

issetFields("manageProfile", $user_details);

if ($isUserChangePassword) {
    $sanitizedData = sanitizeData($_POST["user_mail"], $_POST["username"], $_POST["old_password"], $_POST["new_password"], $_POST["confirm_password"]);
} else {
    $sanitizedData = sanitizeData($_POST["user_mail"], $_POST["username"]);
}

// Vérifier mail

if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
    header("location: ../public/manageprofile.php?error=invalidmail");
    die();
}

// Si veut changer le mdp, vérifier si l'ancien mdp est correct

$userRepo = new UserRepository;

if ($isUserChangePassword) {

    if ($userRepo->checkUserPassword($_SESSION["user"]->getId(), $sanitizedData[2]) == false) {

        header("location: ../public/manageprofile.php?error=wrongpassword");
        die();

    }

    // If new and confirm dont match
    if ($sanitizedData[3] !== $sanitizedData[4]) {
        header("location: ../public/manageprofile.php?error=passwordsdontmatch");
        die();
    }

    $hashedPassword = password_hash($sanitizedData[3], PASSWORD_DEFAULT);

    $userRepo->updatePassword($_SESSION["user"]->getId(), $hashedPassword);

}


$userRepo->updateUser($sanitizedData, $_SESSION["user"]->getId());

// Update Session

$_SESSION["user"]->setMail($sanitizedData[0]);
$_SESSION["user"]->setUsername($sanitizedData[1]);

if ($isUserChangePassword) {
    header("location: ../public/manageprofile.php?success=passwordChanged");
    die();
}

header("location: ../public/manageprofile.php?success=dataChanged");
