<?php

class AddressImpl implements Address
{
    private $firstName;
    private $lastName;
    private $street;
    private $city;
    private $region;
    private $postalCode;
    private $country;

    public function __construct($data)
    {
        $this->firstName = $data['first_name'] ?? "";
        $this->lastName = $data['last_name'] ?? "";
        $this->street = $data['street'] ?? "";
        $this->city = $data['city'] ?? "";
        $this->region = $data['region'] ?? "";
        $this->postalCode = $data['postal_code'] ?? "";
        $this->country = $data['country'] ?? "";
    }

    public function getArrayAddress()
    {
        $data = array();
        $data['first_name'] = $this->getFirstName();
        $data['last_name'] = $this->getLastName();
        $data['street'] = $this->getStreet();
        $data['city'] = $this->getCity();
        $data['region'] = $this->getRegion();
        $data['postal_code'] = $this->getPostalCode();
        $data['country'] = $this->getCountry();

        return $data;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCountry()
    {
        return $this->country;
    }
}