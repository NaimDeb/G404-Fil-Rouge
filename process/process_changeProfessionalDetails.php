<?php
require_once "../utils/autoloader.php";
session_start();
require_once "./process_sanitization.php";


$userRepo = new UserRepository;

$professional_details = ["company_address", "company_name", "company_phone"];

issetFields("manageProfile", $professional_details);

$sanitizedData = sanitizeData($_POST["company_address"], $_POST["company_name"], $_POST["company_phone"]);

// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["company_phone"])) {
    header("location: ../public/manageprofile.php?error=invalidphone");
    die();
}

$userRepo->updateProfessionalDetails(
    $sanitizedData,
    $_SESSION["user"]->getId()
);

// Update session

$_SESSION["user"]->getProfessionalDetails()->setCompany_address($sanitizedData[0]);
$_SESSION["user"]->getProfessionalDetails()->setCompany_name($sanitizedData[1]);
$_SESSION["user"]->getProfessionalDetails()->setCompany_phone($sanitizedData[2]);

header("location: ../public/manageprofile.php?success=professionalDetailsUpdated");
