<?php

declare(strict_types = 1);

namespace Stape\Sgtm;

class EventData
{
    private string $clientId;
    private string $currency;
    private string $ipOverride;
    private string $language;
    private string $pageEncoding;
    private string $pageHostname;
    private string $pageLocation;
    private string $pagePath;
    private string $pageReferrer;
    private string $pageTitle;
    private string $screenResolution;
    private string $userAgent;
    private array $userData;
    private string $userId;
    private string $viewportSize;

    public function __construct(array $data)
    {
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
        $this->userData = $data['user_data'] ?? "";
        $this->userId = $data['user_id'] ?? "";
        $this->viewportSize =  $data['viewport_size'] ?? "";
    }

    public function toArray(): array
    {
        $data = [];
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
        $data['viewport_size'] = $this->getViewportSize();

        return $data;
    }

	public function getClientId(): string
	{
		return $this->clientId;
	}

	public function getCurrency(): string
	{
		return $this->currency;
	}

	public function getIpOverride(): string
	{
		return $this->ipOverride;
	}

	public function getLanguage(): string
	{
		return $this->language;
	}

	public function getPageEncoding(): string
	{
		return $this->pageEncoding;
	}

	public function getPageHostname(): string
	{
		return $this->pageHostname;
	}

	public function getPageLocation(): string
	{
		return $this->pageLocation;
	}

	public function getPagePath(): string
	{
		return $this->pagePath;
	}

	public function getPageReferrer(): string
	{
		return $this->pageReferrer;
	}

	public function getPageTitle(): string
	{
		return $this->pageTitle;
	}

	public function getScreenResolution(): string
	{
		return $this->screenResolution;
	}

	public function getUserAgent(): string
	{
		return $this->userAgent;
	}

	public function getUserData(): array
	{
		return $this->userData;
	}

	public function getUserId(): string
	{
		return $this->userId;
	}

	public function getViewportSize(): string
	{
		return $this->viewportSize;
	}

}