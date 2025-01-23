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

$sanitizedData = sanitizeData($_POST["profile_desc"]);

$userRepo = new UserRepository;

$userRepo->updateProfileDescription(
    $sanitizedData[0],
    $_SESSION["user"]->getId()
);


// Update session

$_SESSION["user"]->setProfile_description($sanitizedData[0]);

header("location: ../public/manageprofile.php");



?>