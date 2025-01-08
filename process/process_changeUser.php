<?php
session_start();
require_once "../utils/connectDB.php";
require_once "./process_sanitization.php";

$user_details = ["user_mail", "username"];

// Check if user wants to change password
// old_password new_password confirm_password
$isUserChangePassword = false;

if (!empty($_POST["old_password"]) || !empty($_POST["new_password"]) || !empty($_POST["confirm_password"])) {
    $isUserChangePassword = true;
    $user_details = ["user_mail", "username", "old_password", "new_password", "confirm_password"];
};

issetFields("manageProfile", $user_details);

if ($isUserChangePassword) {
    $sanitizedData = sanitizeData($_POST["user_mail"], $_POST["username"], $_POST["old_password"], $_POST["new_password"], $_POST["confirm_password"]);
} else {
    $sanitizedData = sanitizeData($_POST["user_mail"], $_POST["username"]);
}

// Vérifier mail

if (!filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {
    header("location: ../public/pages/manageprofile.php?error=invalidmail");
    die();
}

// Si veut changer le mdp, vérifier si l'ancien mdp est correct

if ($isUserChangePassword) {
    $sql = "SELECT user_password FROM user WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_SESSION["user"]["id"]]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // if old password is wrong
    if (!password_verify($sanitizedData[2], $user["user_password"])) {
        header("location: ../public/pages/manageprofile.php?error=wrongpassword");
        die();
    }
    // If new and confirm dont match
    if ($sanitizedData[3] !== $sanitizedData[4]) {
        header("location: ../public/pages/manageprofile.php?error=passwordsdontmatch");
        die();
    }
}

// change sql query depending on if user wants to change password
if ($isUserChangePassword) {
    $sql = "UPDATE user SET user_mail = :user_mail, username = :username, user_password = :user_password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_mail' => $sanitizedData[0],
        ':username' => $sanitizedData[1],
        ':user_password' => password_hash($sanitizedData[3], PASSWORD_DEFAULT),
        ':id' => $_SESSION["user"]["id"]
    ]);
} else {
    $sql = "UPDATE user SET user_mail = :user_mail, username = :username WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_mail' => $sanitizedData[0],
        ':username' => $sanitizedData[1],
        ':id' => $_SESSION["user"]["id"]
    ]);
}

// Update Session

$_SESSION["user"]["username"] = $sanitizedData[1];

header("location: ../public/pages/profile.php?success=1");
