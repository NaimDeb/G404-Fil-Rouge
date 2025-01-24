<?php

class UserDetailsMapper
{

    public static function mapToObject(array $data): UserDetails
    {

        $userDetails = new UserDetails(
            $data["address"],
            $data["phone"],
            $data["country"],
            $data["firstName"],
            $data["lastName"],
            );
            
            return $userDetails;
        }
}
