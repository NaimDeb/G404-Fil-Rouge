<?php
require_once "../utils/autoloader.php";
require_once "./process_sanitization.php";
session_start();

$user_details = ["user_mail", "username"];

// Check if user wants to change password
$isUserChangePassword = false;

if (!empty($_POST["old_password"]) || !empty($_POST["new_password"]) || !empty($_POST["confirm_password"])) {
    $isUserChangePassword = true;
    $user_details = array_merge($user_details, ["old_password", "new_password", "confirm_password"]);
}

$sanitizedData = [];
foreach ($user_details as $detail) {
    // Isset and sanitize
    if (!isset($_POST[$detail]) || empty($_POST[$detail])) {
        header("location: ../public/manageprofile.php?error=emptyfield");
        die();
    }
    $sanitizedData[$detail] = sanitizeData($_POST[$detail]);
}

// Vérifier mail
if (!filter_var($sanitizedData["user_mail"], FILTER_VALIDATE_EMAIL)) {
    header("location: ../public/manageprofile.php?error=invalidmail");
    die();
}

$userRepo = new UserRepository;

if ($isUserChangePassword) {
    // Verify old password
    if (!$userRepo->checkUserPassword($_SESSION["user"]->getId(), $sanitizedData["old_password"])) {
        header("location: ../public/manageprofile.php?error=wrongpassword");
        die();
    }
    // Update password
    $userRepo->updatePassword($_SESSION["user"]->getId(), $sanitizedData["new_password"]);
}

// Update user details
$userRepo->updateUser(
    $sanitizedData,
    $_SESSION["user"]->getId()
);

// Update session
$_SESSION["user"]->setMail($sanitizedData["user_mail"]);
$_SESSION["user"]->setUsername($sanitizedData["username"]);

header("location: ../public/manageprofile.php?success=userDetailsUpdated");
