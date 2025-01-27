<?php

class TypeMapper
{
    public static function mapToObject(array $type): Type
    {
        return new Type($type['type_name'], $type['id']);
    }
}