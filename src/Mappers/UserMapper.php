<?php

class UserMapper
{

    public static function mapToObject(array $data)
    {

        if (isset($data['company_id'])) {
            $user = new Professional(
                $data['id'],
                $data['username'],
                $data['user_password'],
                $data['user_mail'],
                $data['profile_desc'],
                $data['role'],
                $data['img_path'],
                $data['company_id'],
                $data['company_name'],
                $data['company_address'],
                $data['company_phone']
            );
        } else {
            $user = new Client(
                $data['id'],
                $data['username'],
                $data['user_password'],
                $data['user_mail'],
                $data['profile_desc'],
                $data['role'],
                $data['img_path']
            );
        }

        $user->setAddress($data['address']);
        $user->setPhone($data['phone']);
        $user->setCountry($data['country']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);

        return $user;
    }
}
