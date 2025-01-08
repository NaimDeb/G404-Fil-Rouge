<?php
session_start();
require_once "../utils/connectDB.php";
require_once "./process_sanitization.php";


$user_details = [ "firstName", "lastName", "address", "phone", "country"];

issetFields("manageProfile", $user_details);

$sanitizedData = sanitizeData($_POST["firstName"], $_POST["lastName"], $_POST["address"], $_POST["phone"], $_POST["country"]);


// Vérifier num téléphone

if (!preg_match("/^[0-9]*$/", $_POST["phone"])) {
    header("location: ../public/pages/manageprofile.php?error=invalidphone");
    die();
}

$sql = "UPDATE user_details SET firstName = :firstName, lastName = :lastName, address = :address, phone = :phone, country = :country WHERE id_user = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':firstName' => $sanitizedData[0],
    ':lastName' => $sanitizedData[1],
    ':address' => $sanitizedData[2],
    ':phone' => $sanitizedData[3],
    ':country' => $sanitizedData[4],
    ':id' => $_SESSION["user"]["id"]
]);

header("location: ../public/pages/profile.php");

