<?php


class UserDetails{

    private string $address;
    private string $phone;
    private string $country;
    private string $firstName;
    private string $lastName;
    private string $img_url;


    public function __construct(string $address, string $phone, string $country, string $firstName, string $lastName,string $img_url)	
    {
        $this->address = $address;
        $this->phone = $phone;
        $this->country = $country;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->img_url = $img_url;
    }






    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of country
     */ 
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */ 
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of img_url
     */ 
    public function getImg_url()
    {
        return $this->img_url;
    }

    /**
     * Set the value of img_url
     *
     * @return  self
     */ 
    public function setImg_url($img_url)
    {
        $this->img_url = $img_url;

        return $this;
    }
}


?>