<?php

require_once "../utils/autoloader.php";

// Isset et sanitization

if (!isset($_POST["mailOrUsername"]) || empty($_POST["mailOrUsername"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
    header("location: ../public/pages/login.php?error=emptyfield");
    die();
}


// Check if user exists

$firstInput = htmlspecialchars(trim($_POST["mailOrUsername"]));


$userRepo = new UserRepository;

$user = $userRepo->fetchUserByMailOrUsername($firstInput);


if (!$user) {
    header("location: ../public/pages/login.php?error=1");
    die();
}

// Check password

if (!password_verify($_POST["password"], $user->getPassword())) {
    header("location: ../public/pages/login.php?error=1");
    die();
}

// Connect to session

session_start();

$_SESSION["user"] = $user;

header("location: ../index.php");