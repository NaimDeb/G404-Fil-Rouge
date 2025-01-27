<?php
require_once "../utils/autoloader.php";
session_start();
require_once "./process_sanitization.php";

$user_details = [ "firstName", "lastName", "address", "phone", "country"];


// Sanitization 
$sanitizedData = [];
foreach ($user_details as $detail) {
    // Isset and sanitize
    if (!isset($_POST[$detail]) || empty($_POST[$detail])) {
        header("location: ../public/manageprofile.php?error=emptyfield");
        die();
    }
    $sanitizedData[$detail] = sanitizeData($_POST[$detail]);
}



// $userRepo = new UserRepository;
$userDetailsRepo = new UserDetailsRepository;

// Update user details
$userDetailsRepo->updateUserDetails(
    $sanitizedData,
    $_SESSION["user"]->getId()
);

// Update session
$_SESSION["userDetails"]->setFirstName($sanitizedData["firstName"]);
$_SESSION["userDetails"]->setLastName($sanitizedData["lastName"]);
$_SESSION["userDetails"]->setAddress($sanitizedData["address"]);
$_SESSION["userDetails"]->setPhone($sanitizedData["phone"]);
$_SESSION["userDetails"]->setCountry($sanitizedData["country"]);

header("location: ../public/manageprofile.php?success=userDetailsUpdated");

//! Probleme ça n'envoie rien dans la DB