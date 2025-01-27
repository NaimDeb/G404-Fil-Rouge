<?php

class GenreMapper
{
    public static function mapToObject(array $genre): Genre
    {
        return new Genre($genre['name'], $genre['id']);
    }
}

?>