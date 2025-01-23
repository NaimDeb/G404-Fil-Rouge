<?php
require_once "../utils/autoloader.php";
require_once "./process_sanitization.php";
session_start();

$user_details = [ "firstName", "lastName", "address", "phone", "country"];

issetFields("manageProfile", $user_details);

$sanitizedData = sanitizeData($_POST["firstName"], $_POST["lastName"], $_POST["address"], $_POST["phone"], $_POST["country"]);


// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["phone"])) {
    header("location: ../public/manageprofile.php?error=invalidphone");
    die();
}

$userRepo = new UserRepository;

$userRepo->updateUserDetails($sanitizedData, $_SESSION["user"]->getId());

$_SESSION["user"]->getUserDetails()->setFirstName($sanitizedData[0]);
$_SESSION["user"]->getUserDetails()->setLastName($sanitizedData[1]);
$_SESSION["user"]->getUserDetails()->setAddress($sanitizedData[2]);
$_SESSION["user"]->getUserDetails()->setPhone($sanitizedData[3]);
$_SESSION["user"]->getUserDetails()->setCountry($sanitizedData[4]);


header("location: ../public/manageprofile.php");

