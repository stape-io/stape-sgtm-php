<?php

class EventDataImpl extends UserDataImpl implements EventData
{
    private $clientId;
    private $currency;
    private $ipOverride;
    private $language;
    private $pageEncoding;
    private $pageHostname;
    private $pageLocation;
    private $pagePath;
    private $pageReferrer;
    private $pageTitle;
    private $screenResolution;
    private $userAgent;
    private $userData;
    private $userId;
    private $value;
    private $viewportSize;

    public function __construct($data)
    {
        parent::__construct($data['user_data'] ?? array());
        $this->clientId = $data['client_id'] ?? "";
        $this->currency = $data['currency'] ?? "";
        $this->ipOverride = $data['ip_override'] ?? "";
        $this->language = $data['language'] ?? "";
        $this->pageEncoding = $data['page_encoding'] ?? "";
        $this->pageHostname = $data['page_hostname'] ?? "";
        $this->pageLocation = $data['page_location'] ?? "";
        $this->pagePath = $data['page_path'] ?? "";
        $this->pageReferrer = $data['page_referrer'] ?? "";
        $this->pageTitle = $data['page_title'] ?? "";
        $this->screenResolution = $data['screen_resolution'] ?? "";
        $this->userAgent = $data['user_agent'] ?? "";
        $this->userData = $this->getArrayUserData();
        $this->userId = $data['user_id'] ?? "";
        $this->value = $data['value'] ?? "";
        $this->viewportSize =  $data['viewport_size'] ?? "";
    }

    public function arrayEventData()
    {
        $data = array();
        $data['client_id'] = $this->getClientId();
        $data['currency'] = $this->getCurrency();
        $data['ip_override'] = $this->getIpOverride();
        $data['language'] = $this->getLanguage();
        $data['page_encoding'] = $this->getPageEncoding();
        $data['page_hostname'] = $this->getPageHostname();
        $data['page_location'] = $this->getPageLocation();
        $data['page_path'] = $this->getPagePath();
        $data['page_referrer'] = $this->getPageReferrer();
        $data['page_title'] = $this->getPageTitle();
        $data['screen_resolution'] = $this->getScreenResolution();
        $data['user_agent'] = $this->getUserAgent();
        $data['user_data'] = $this->getUserData();
        $data['user_id'] = $this->getUserId();
        $data['value'] = $this->getValue();
        $data['viewport_size'] = $this->getViewportSize();

        return $data;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getIpOverride()
    {
        return $this->ipOverride;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getPageEncoding()
    {
        return $this->pageEncoding;
    }

    public function getPageHostname()
    {
        return $this->pageHostname;
    }

    public function getPageLocation()
    {
        return $this->pageLocation;
    }

    public function getPagePath()
    {
        return $this->pagePath;
    }

    public function getPageReferrer()
    {
        return $this->pageReferrer;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function getScreenResolution()
    {
        return $this->screenResolution;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function getUserData()
    {
        return $this->userData;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getViewportSize()
    {
        return $this->viewportSize;
    }
}