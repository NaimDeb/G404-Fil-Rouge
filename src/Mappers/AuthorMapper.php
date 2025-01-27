<?php

class AuthorMapper
{
    public static function mapToObject(array $author): Author
    {
        return new Author($author['name'], $author['biography'], $author['id']);
    }
}