<?php

class ProfessionalDetailsMapper
{

    public static function mapToObject(array $data)
    {

        $professionalDetails = new ProfessionalDetails(
            $data['id'],
            $data['company_name'],
            $data['company_address'],
            $data['company_phone']
        );

        return $professionalDetails;
    }
}
