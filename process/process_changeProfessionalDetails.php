<?php
require_once "../utils/autoloader.php";
session_start();
require_once "./process_sanitization.php";



$professional_details = ["company_address", "company_name", "company_phone"];

$sanitizedData = [];
foreach ($professional_details as $detail) {
    // Isset and sanitize
    if (!isset($_POST[$detail]) || empty($_POST[$detail])) {
        header("location: ../public/manageprofile.php?error=emptyfield");
        die();
    }
    $sanitizedData[$detail] = sanitizeData($_POST[$detail]);
}

// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["company_phone"])) {
    header("location: ../public/manageprofile.php?error=invalidphone");
    die();
}


$proDetailsRepo = new ProfessionalDetailsRepository;

$proDetailsRepo->updateProfessionalDetails(
    $sanitizedData,
    $_SESSION["user"]->getId()
);

// Update session

$_SESSION["professionalDetails"]->setCompany_address($sanitizedData["company_address"]);
$_SESSION["professionalDetails"]->setCompany_name($sanitizedData["company_name"]);
$_SESSION["professionalDetails"]->setCompany_phone($sanitizedData["company_phone"]);

header("location: ../public/manageprofile.php?success=professionalDetailsUpdated");
