<?php


function issetFields($page, $fields)
{
    foreach ($fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            header("location: ../public/{$page}.php?error=emptyfield&error={$field}");
            die();
        }
    }
}


function sanitizeData($value)

{

    $sanitizedData = htmlspecialchars(trim($value));

    return $sanitizedData;
}

?>