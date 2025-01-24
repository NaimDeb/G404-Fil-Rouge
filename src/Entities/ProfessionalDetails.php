<?php

class ProfessionalDetails{



    private int $company_id;
    private string $company_name;
    private string $company_address;
    private string $company_phone;


    private User $user;

    public function __construct($company_id, $company_name, $company_address, $company_phone) {
        $this->company_id = $company_id;
        $this->company_name = $company_name;
        $this->company_address = $company_address;
        $this->company_phone = $company_phone;
    }


    /**
     * Get the value of company_id
     */ 
    public function getCompany_id()
    {
        return $this->company_id;
    }

    /**
     * Set the value of company_id
     *
     * @return  self
     */ 
    public function setCompany_id($company_id)
    {
        $this->company_id = $company_id;

        return $this;
    }

    /**
     * Get the value of company_name
     */ 
    public function getCompany_name()
    {
        return $this->company_name;
    }

    /**
     * Set the value of company_name
     *
     * @return  self
     */ 
    public function setCompany_name($company_name)
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * Get the value of company_address
     */ 
    public function getCompany_address()
    {
        return $this->company_address;
    }

    /**
     * Set the value of company_address
     *
     * @return  self
     */ 
    public function setCompany_address($company_address)
    {
        $this->company_address = $company_address;

        return $this;
    }

    /**
     * Get the value of company_phone
     */ 
    public function getCompany_phone()
    {
        return $this->company_phone;
    }

    /**
     * Set the value of company_phone
     *
     * @return  self
     */ 
    public function setCompany_phone($company_phone)
    {
        $this->company_phone = $company_phone;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}

?>