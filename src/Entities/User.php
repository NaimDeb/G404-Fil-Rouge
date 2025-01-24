<?php

class User {

    private int $id;
    private string $username;
    private string $password;
    private string $mail;
    private string $profile_description;
    private string $role;

    // A enlever
    // private UserDetails $userDetails;
    // private ?ProfessionalDetails $professionalDetails = null;

    private Image $image;

    
	



    public function __construct($id, $username, $password, $mail, $profile_description, $role){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->mail = $mail;
        $this->profile_description = $profile_description;
        $this->role = $role;
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
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of profile_description
     *
     * @return  self
     */ 
    public function setProfile_description($profile_description)
    {
        $this->profile_description = $profile_description;

        return $this;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }
}


?>