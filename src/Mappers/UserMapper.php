<?php

class UserMapper
{

    public static function mapToObject(array $data, Image $image = null): User
    {


        $user = new User(
            $data['id'],
            $data['username'],
            $data['user_password'],
            $data['user_mail'],
            $data['profile_desc'],
            $data['role'],
        );

        if (!$image) {
            $imageRepo = new ImageRepository();
            $image = $imageRepo->getDefaultUserImage();
        }

        $user->setImage($image);


        return $user;
    }
}
