<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/BookMarket/globals.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BookMarket/utils/connectDB.php';

// Isset et sanitization

if (!isset($_POST["mailOrUsername"]) || empty($_POST["mailOrUsername"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
    header("location: ../public/pages/login.php?error=emptyfield");
    die();
}


// Check if user exists


$firstInput = htmlspecialchars(trim($_POST["mailOrUsername"]));

$sql = "SELECT * FROM user WHERE user_mail = :input OR username = :input";

$stmt = $pdo->prepare($sql);

$stmt->execute(['input' => $firstInput]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("location: ../public/pages/login.php?error=1");
    die();
}

// Check password

if (!password_verify($_POST["password"], $user["user_password"])) {
    header("location: ../public/pages/login.php?error=1");
    die();
}

// Connect to session

session_start();

$_SESSION["user"] = [
    "id" => $user["id"],
    "username" => $user["username"],
    "role" => $user["role"],
    "image" => $user["id_image"]
];

header("location: ../index.php");