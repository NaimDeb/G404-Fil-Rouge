<?php

class ProfessionalDataMapper
{

    public static function mapToObject(array $data)
    {

        $professionalDetails = new ProfessionalDetails(
            $data['company_id'],
            $data['company_name'],
            $data['company_address'],
            $data['company_phone']
        );

        return $professionalDetails;
    }
}
