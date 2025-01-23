<?php

final class Professional extends User{

    protected $company_id;
    protected $company_name;
    protected $company_address;
    protected $company_phone;

    public function __construct($id, $username, $password, $mail, $profile_description, $role, $img_url, $company_id, $company_name, $company_address, $company_phone) {
        parent::__construct($id, $username, $password, $mail, $profile_description, $role, $img_url);
        $this->company_id = $company_id;
        $this->company_name = $company_name;
        $this->company_address = $company_address;
        $this->company_phone = $company_phone;
    }





}

?>