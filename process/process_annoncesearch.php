<?php


require_once("../utils/autoloader.php");

// Au cas ou il n'y a pas de requete
if (!isset($_GET["q"])){
    die();
}

//get the q parameter from URL
$query=$_GET["q"];

$productRepo = new ProductRepository;

$listeProducts = $productRepo->searchProductsByName($query);



if (count($listeProducts)==0) {
  $response="no suggestion";
  echo $response;
  exit;
} 


$htmlString = "";
foreach ($listeProducts as $element) {

    $titre = $element['name'];
    $artiste = $element['author_name'];

        $htmlString .= '
        <div class="flex items-center space-x-4 bg-neutral-off-white p-4 hover:bg-gray-200 group transition" onclick="selectProduct(this)">
            <div class>
            <h3 class="text-black text-md font-semibold">' . $titre . '</h3>
            <p class="text-gray-500 text-sm">' . $artiste . '</p>
            </div>
        </div>
        ';
 
}







// Set output to "no suggestion" if no hint was found
// or to the correct values
$response=$htmlString;

//output the response
echo $response;
?> 

