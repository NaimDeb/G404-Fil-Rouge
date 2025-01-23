<?php

final class Client extends User{



    public function __construct($id, $username, $password, $mail, $profile_description, $role, $img_url) {
        parent::__construct($id, $username, $password, $mail, $profile_description, $role, $img_url);
    }


}


?>