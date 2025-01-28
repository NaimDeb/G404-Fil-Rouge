<?php
require_once "../utils/autoloader.php";
session_start();


var_dump($_FILES);
die();

if (!isset($_SESSION["user"] ,$_POST, $_FILES)) {
    header("location: ../public/sell.php?error=1");
    die();
}

$user = $_SESSION["user"];

if (!isset($_POST["product_name"], $_POST["product_specifications"], $_POST["product_author_id"], $_POST["price"], $_POST["condition"], $_FILES["official_image"], $_FILES["image"])) {
    header("location: ../public/sell.php?error=emptyfields");
    die();
}

$productImages = $_FILES["image"];

$productName = htmlspecialchars($_POST["title"]);
$productAuthor = htmlspecialchars($_POST["author"]);

$price = htmlspecialchars($_POST["price"]);

$productDescription = htmlspecialchars($_POST["description"]);

$condition = htmlspecialchars($_POST["condition"]);

// Validate condition
$validConditions = ["new", "like_new", "good", "acceptable", "damaged"];
if (!in_array($condition, $validConditions)) {
    header("location: ../public/sell.php?error=invalidcondition");
    die();
}

// Validate condition
$validConditions = [
    "new" => "New",
    "like_new" => "Like_New",
    "good" => "Good",
    "acceptable" => "Acceptable",
    "damaged" => "Damaged"
];

$condition = $validConditions[$condition];

if (!array_key_exists($condition, $validConditions)) {
    header("location: ../public/sell.php?error=invalidcondition");
    die();
}

// Validate and convert price
if (!is_numeric($price)) {
    header("location: ../public/sell.php?error=invalidprice");
    die();
}
$price = intval(floatval($price) * 100);

// Validate images
foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
    $check = getimagesize($tmp_name);
    if ($check === false) {
        header("location: ../public/sell.php?error=invalidimage");
        die();
    }
}



// Check if product already exists in db
$productRepo = new ProductRepository();

$product = $productRepo->fetchProductByName($productName);

// Create new product if it doesn't exist
if (!$product) {
    // Check if author exists already

    $authorRepo = new AuthorRepository();

    $author = $authorRepo->fetchByName($productAuthor);

    if (!$author) {
        $author = new Author($productAuthor);
        $authorRepo->createAuthor($author);
    }




    $product = new Product($productName);

    $product->setAuthor($author);

    // For now, only books, so type 1
    $product->setType(new Type(1));

    $productRepo->createProduct($product);
}

// Create annonce
$annonceRepo = new AnnonceRepository();


$annonce = new Annonce($price, $condition);

$annonce->setProduct($product);

$annonce->setUser($user);

$imageRepo = new ImageRepository;

$images = [];

foreach ($_FILES["image"]["error"] as $index => $error) {
    if ($error !== 0) {
        throw new Exception("Image error", 1);
        header("location: ../public/sell.php?error=uploadfailed");
        
    }
}

$uploadDir = '../public/assets/images/annonces/';

foreach ($_FILES["image"]["tmp_name"] as $index => $tmp_name) {

    $imageName = uniqid() . $_FILES["image"]["name"][$index];
    $uploadFile = $uploadDir . $imageName;

    if (!move_uploaded_file($tmp_name, $uploadFile)) {
        header("location: ../public/sell.php?error=uploadfailed");
        die(); 
    }

    $imageId = $imageRepo->createImage($imageName);

    $image = new Image($imageName, $imageId, "image d'annonce de produit");

    $images[] = $image;
    
}

$annonce->setImages($images);

// Creation annonce

$annonceId = $annonceRepo->createAnnonce($annonce);

header("location: ../public/article?id=$annonceId");
?>