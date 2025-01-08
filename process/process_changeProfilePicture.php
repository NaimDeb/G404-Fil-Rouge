<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']  . '/BookMarket/globals.php';
require $_SERVER['DOCUMENT_ROOT']  . '/BookMarket/utils/connectDB.php';
require $_SERVER['DOCUMENT_ROOT']  . '/BookMarket/process/process_updateSession.php';


$profile_picture = $_FILES["profile_picture"];

$idImage = null;

// On vérifie si c'est une image

if ($profile_picture["error"] !== UPLOAD_ERR_OK) {
    echo("Erreur lors de l'upload de l'image");
    die();
}
    

$uploadDir = "/BookMarket/assets/src/images/users/";
$fileName = uniqid() . basename($profile_picture["name"]);


$uploadPath = $uploadDir . $fileName;
$phpUploadPath = $_SERVER['DOCUMENT_ROOT']  . $uploadPath;

if (move_uploaded_file($profile_picture["tmp_name"], $phpUploadPath)) {

    try {

        $sql = "INSERT INTO image (img_path) VALUES (:image_path)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':image_path' => $uploadPath
        ]);

        $idImage = $pdo->lastInsertId();

        $_SESSION["user"]["image"] = $idImage;

        $sql = "UPDATE user SET id_image = :id_image WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':id_image' => $idImage,
            ':id' => $_SESSION["user"]["id"]
        ]);

        updateSession();

        echo ("Image mise à jour avec succès");
        echo "<script>window.location.href = document.referrer;</script>";
        die();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }


} else {
    echo "Failed to move uploaded file.";
}


?>