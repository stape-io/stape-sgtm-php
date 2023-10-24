<?php

declare(strict_types = 1);

namespace Stape\Sgtm;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class StapeSGTM
{
    private array $config;
    private Client $client;

	/**
	 * @throws SGTMException
	 */
	public function __construct(
		string $gtmServerDomain,
		string $requestPath = '/data',
		bool $richsstsse = false,
		int $protocolVersion = 2)
    {
        $this->config = array(
            'gtm_server_domain' => $gtmServerDomain,
            'request_path' => $requestPath,
            'richsstsse' => $richsstsse,
            'protocol_version' => $protocolVersion
        );

        $this->client = new Client();
        $this->validateConfig();
    }

	/**
	 * @throws SGTMException
	 */
	public function sendEventData(string $eventName, array $eventData = []): bool
    {
		$eventData = new EventData($eventData);
        $urlResult = $this->formatUrl($eventName, $eventData);
        $url = $urlResult['url'];
        $postData = $urlResult['postData'];

        return $this->sendEvent($url, $postData);
    }

    private function formatUrl(string $eventName, EventData $eventData): array
    {
        $url = $this->config['gtm_server_domain'] . $this->config['request_path'];
        $queryString = \parse_url($url, PHP_URL_QUERY);
        \parse_str($queryString, $params);

        $params['v'] = $this->config['protocol_version'];
        $params['event_name'] = \urlencode($eventName);

        if ($this->config['richsstsse']) {
            $params['richsstsse'] = '';
        }

        $url = $url . "&" . \http_build_query($params);

        $postData = [
            'event_name' => $eventName,
        ];

        $postData = ['form_params' => \array_merge($postData, $eventData->toArray())];

        return ['url' => $url, 'postData' => $postData];
    }

	/**
	 * @throws SGTMException
	 */
	private function sendEvent($url, $postData): bool
    {
        try {
            $response = $this->client->request('POST', $url, $postData);

            return $response->getStatusCode() === 200;
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $status = $response ? $response->getStatusCode() : null;
            $statusText = $response ? $response->getReasonPhrase() : null;

            $error = $response ? (string) $response->getBody() : null;

            throw new SGTMException($status, $statusText, $error, "HTTP request failed {$status}");
        }
    }

	/**
	 * @throws SGTMException
	 */
	public function validateConfig(): void
    {
        if (
            !isset($this->config['gtm_server_domain']) ||
            !preg_match('/^https:\/\//', $this->config['gtm_server_domain']) ||
            preg_match('/^\//', $this->config['gtm_server_domain'])
        ) {
            throw new SGTMException(null, null, null, 'You did not fill in the variable gtm_server_domain. Example: https://gtm.stape.io');
        }
        if (
            !isset($this->config['request_path']) ||
            !preg_match('/\//', $this->config['request_path'])
        ) {
            throw new SGTMException(null, null, null, 'You did not fill in the variable request_path. Example: /');
        }
    }
}
