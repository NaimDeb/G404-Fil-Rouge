<?php
require_once "../utils/autoloader.php";
session_start();



// Isset et sanitization

if (!isset($_POST["mailOrUsername"]) || empty($_POST["mailOrUsername"]) || !isset($_POST["password"]) || empty($_POST["password"])) {
    header("location: ../public/login.php?error=emptyfield");
    die();
}


// Check if user exists

$firstInput = htmlspecialchars(trim($_POST["mailOrUsername"]));


$userRepo = new UserRepository;

$user = $userRepo->fetchUserByMailOrUsername($firstInput);

if (!$user) {
    header("location: ../public/login.php?error=1");
    die();
}

$user->setImage($userRepo->getImageOfUser($user->getId()));




 // User details
$userDetailsRepo = new UserDetailsRepository;
        
$userDetails = $userDetailsRepo->getUserDetailsByUserId($user->getId());
 
$userDetails->setUser($user);

// Professional Details
$proDetailsRepo = new ProfessionalDetailsRepository;

$proDetails = $proDetailsRepo->getProDetailsByUserId($user->getId());

if ($professionalDetails) {
    $professionalDetails->setUser($user);
}




// Check password

if (!password_verify($_POST["password"], $user->getPassword())) {
    header("location: ../public/login.php?error=1");
    die();
}

// Connect to session



$_SESSION["user"] = $user;
$_SESSION["userDetails"] = $userDetails;
$_SESSION["professionalDetails"] = $proDetails;


header("location: ../index.php");



// ! todo : Doesn't work if there's no professional data for the user
// ! todo : doesn't work