<?php

class UserMapper
{

    public static function mapToObject(array $data)
    {


        $user = new User(
            $data['id'],
            $data['username'],
            $data['user_password'],
            $data['user_mail'],
            $data['profile_desc'],
            $data['role'],
        );


        return $user;
    }
}
