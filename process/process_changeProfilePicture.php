<?php
require_once "../utils/autoloader.php";
session_start();


$profile_picture = $_FILES["profile_picture"];

$idImage = null;

// On vérifie si c'est une image

if ($profile_picture["error"] !== UPLOAD_ERR_OK) {
    echo("Erreur lors de l'upload de l'image");
    die();
}
    

$uploadDir = "../public/assets/images/users/";
$fileName = uniqid() . basename($profile_picture["name"]);


$uploadPath = $uploadDir . $fileName;

if (!move_uploaded_file($profile_picture["tmp_name"], $uploadPath)) {
    echo "Failed to move uploaded file.";
    die();
} else {

    $userRepo = new UserRepository;

    $userRepo->updateProfilePicture($_SESSION["user"]->getId(), $fileName);

    $_SESSION["user"]->getUserDetails()->setImg_url($fileName);

    echo ("Image mise à jour avec succès");
    // Refresh page
    echo "<script>window.location.href = document.referrer;</script>";
    die();
}

// Update session



?>