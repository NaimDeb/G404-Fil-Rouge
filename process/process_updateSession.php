<?php

function updateSession()
{
    require $_SERVER['DOCUMENT_ROOT'] . '/BookMarket/utils/connectDB.php';

    $query = $pdo->prepare("SELECT * FROM user JOIN image ON user.id_image = image.id WHERE user.id = :id");
    $query->execute([
        'id' => $_SESSION["user"]['id']
    ]);
    $user = $query->fetch();

    $_SESSION["user"]['id'] = $user['id'];
    $_SESSION["user"]['username'] = $user['username'];
    $_SESSION["user"]['role'] = $user['role'];
    $_SESSION["user"]['image'] = $user['id_image'];
    $_SESSION["user"]['imgPath'] = $user['img_path'];
}


?>