<?php

require $_SERVER['DOCUMENT_ROOT']  . '/BookMarket/globals.php';

try{
    $host = "localhost";
    $dbname = "bookmarket";
    $login = $loginDB;
    $password = $passwordDB;

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);

} catch (PDOException $e) {
    echo "Erreur de connexion a la base de données : " . $e->getMessage();
}
?>