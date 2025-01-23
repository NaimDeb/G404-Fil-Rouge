<?php

class UserMapper
{

    public static function mapToObject(array $data)
    {

        if (isset($data['company_id'])) {
            return new Professional(
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
            return new Client(
                $data['id'],
                $data['username'],
                $data['user_password'],
                $data['user_mail'],
                $data['profile_desc'],
                $data['role'],
                $data['img_path']
            );
        }
    }
}
