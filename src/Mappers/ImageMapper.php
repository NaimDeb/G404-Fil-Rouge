<?php

class ImageMapper
{
    public static function mapToObject(array $data)
    {
        $image = new Image(
            id : $data['id'],
            imgPath : $data['img_path'],
        );

        return $image;
    }
}