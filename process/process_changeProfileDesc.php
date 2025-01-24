<?php
require_once "../utils/autoloader.php";
session_start();
require_once "./process_sanitization.php";



// Vérification POST et si user existe
if (!isset($_SESSION["user"]) || !isset($_POST)) {
    header("location: ../public/manageProfile.php");
    die();
}


//  ------- Profile Description -------

$user_details = ["profile_desc"];

issetFields("manageProfile", $user_details);


// Isset and sanitize
if (!isset($_POST["profile_desc"]) || empty($_POST["profile_desc"])) {
    header("location: ../public/manageprofile.php?error=emptyfield");
    die();
}
$sanitizedData = sanitizeData($_POST["profile_desc"]);


$userRepo = new UserRepository;

$userRepo->updateProfileDescription(
    $sanitizedData,
    $_SESSION["user"]->getId()
);


// Update session

$_SESSION["user"]->setProfile_description($sanitizedData);
header("location: ../public/manageprofile.php");



?>