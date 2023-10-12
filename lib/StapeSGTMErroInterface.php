<?php
interface StapeSGTMErroInterface
{
    function sendEventData(
        $event_name,
        $eventData
    );
}

interface Address {
    public function getFirstName();
    public function getLastName();
    public function getStreet();
    public function getCity();
    public function getRegion();
    public function getPostalCode();
    public function getCountry();
}

interface UserData {
    public function getSha256EmailAddress();
    public function getPhoneNumber();
    public function getAddress();
}

interface EventData {
    public function getClientId();
    public function getCurrency();
    public function getIpOverride();
    public function getLanguage();
    public function getPageEncoding();
    public function getPageHostname();
    public function getPageLocation();
    public function getPagePath();
    public function getPageReferrer();
    public function getPageTitle();
    public function getScreenResolution();
    public function getUserAgent();
    public function getUserData();
    public function getUserId();
    public function getValue();
    public function getViewportSize();
}