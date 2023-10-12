<?php

class UserDataImpl extends AddressImpl implements UserData
{
    private $emailAddress;
    private $phoneNumber;
    private $address;

    public function __construct($data)
    {
        parent::__construct($data['address'] ?? array());
        $this->emailAddress = $data['sha256_email_address'] ?? "";
        $this->phoneNumber = $data['phone_number'] ?? "";
        $this->address = $this->getArrayAddress();
    }

    public function getArrayUserData()
    {
        $data = array();
        $data['sha256_email_address'] =  $this->getSha256EmailAddress();
        $data['phone_number'] =  $this->getPhoneNumber();
        $data['address'] =  $this->getAddress();

        return $data;
    }

    public function getSha256EmailAddress()
    {
        return hash('sha256', $this->emailAddress);
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getAddress()
    {
        return $this->address;
    }
}