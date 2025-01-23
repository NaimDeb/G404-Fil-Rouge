<?php

abstract class User {

    protected int $id;
    protected string $username;
    protected string $password;
    protected string $mail;
    protected string $profile_description;
    protected string $role;
    protected string $img_url;

    public function __construct($id, $username, $password, $mail, $profile_description, $role, $img_url){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->mail = $mail;
        $this->profile_description = $profile_description;
        $this->role = $role;
        $this->img_url = $img_url;
    }



    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }



    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Get the value of profile_description
     */ 
    public function getProfile_description()
    {
        return $this->profile_description;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of img_url
     */ 
    public function getImg_url()
    {
        return $this->img_url;
    }
}


?>