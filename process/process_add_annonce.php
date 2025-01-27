<?php
require_once "../utils/autoloader.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("location: ../public/home.php");
    die();
}

$user = $_SESSION["user"];

// Get form data
$productName = htmlspecialchars(trim($_POST["product_name"]));
$productSpecifications = htmlspecialchars(trim($_POST["product_specifications"]));
$productAuthorId = intval($_POST["product_author_id"]);
$productTypeId = 1; // Assuming type is always 1 for now

// Check if product exists
$productRepo = new ProductRepository();
$product = $productRepo->fetchProductByName($productName);

if (!$product) {
    // Create new product
    $imageRepo = new ImageRepository();
    $image = $imageRepo->createImage($_FILES["official_image"]);

    $product = new Product($productName, $productSpecifications);
    $product->setImage($image);
    $product->setAuthor(new Author($productAuthorId));
    $product->setType(new Type($productTypeId));

    $productRepo->createProduct($product);
}

// Create annonce
$annonceRepo = new AnnonceRepository();
$annonce = new Annonce($_POST["price"], $_POST["condition"]);
$annonce->setProduct($product);
$annonce->setUser($user);

$images = [];
foreach ($_FILES["image"]["tmp_name"] as $key => $tmp_name) {
    $image = $imageRepo->createImage($_FILES["image"]["name"][$key]);
    $images[] = $image;
}
$annonce->setImages($images);

$annonceRepo->createAnnonce($annonce);

header("location: ../public/home.php?success=annonce_created");
?>