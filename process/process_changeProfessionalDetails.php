<?php
session_start();
require_once "../utils/connectDB.php";
require_once "./process_sanitization.php";

$professional_details = ["company_address", "company_name", "company_phone"];

issetFields("manageProfile", $professional_details);

$sanitizedData = sanitizeData($_POST["company_address"], $_POST["company_name"], $_POST["company_phone"]);

// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["company_phone"])) {
    header("location: ../public/manageprofile.php?error=invalidphone");
    die();
}

$sql = "UPDATE professional_details SET company_address = :company_address, company_name = :company_name, company_phone = :company_phone WHERE id_user = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':company_address' => $sanitizedData[0],
    ':company_name' => $sanitizedData[1],
    ':company_phone' => $sanitizedData[2],
    ':id' => $_SESSION["user"]["id"]
]);

header("location: ../public/profile.php");
