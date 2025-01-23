<?php
session_start();
require_once "../utils/autoloader.php";


$userRepo = new UserRepository;

// Vérification POST et si user existe
if (!isset($_SESSION["user"]) || !isset($_POST)) {
    header("location: ../public/manageProfile.php");
    die();
}


//  ------- Profile Description -------

$user_details = ["profile_desc"];

issetFields("manageProfile", $user_details);

$sanitizedData = sanitizeData($_POST["profile_desc"]);


$sql = "UPDATE user SET profile_desc = :profile_desc WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':profile_desc' => $sanitizedData[0],
    ':id' => $_SESSION["user"]["id"]

]);

header("location: ../public/profile.php");



?>