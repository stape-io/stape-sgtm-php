<?php

declare(strict_types=1);

namespace Stape\Sgtm;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class StapeSGTMClient
{
    private array $config;
    private HttpClientInterface $client;

    /**
     * @throws SGTMException
     */
    public function __construct(
        HttpClientInterface $client,
        string $gtmServerDomain,
        string $requestPath = '/data',
        bool $richsstsse = false,
        int $protocolVersion = 2,
    ) {
        $this->config = array(
            'gtm_server_domain' => $gtmServerDomain,
            'request_path' => $requestPath,
            'richsstsse' => $richsstsse,
            'protocol_version' => $protocolVersion
        );

        $this->client = $client;
        $this->validateConfig();
    }

    /**
     * @throws SGTMException
     */
    public function sendEventData(string $eventName, array $eventData = [], ?callable $callback = null): ResponseInterface
    {
        $eventData = new EventData($eventData);
        $urlResult = $this->formatUrl($eventName, $eventData);
        $url = $urlResult['url'];
        $data = $urlResult['postData'];

        if ($callback) {
            $data = ['on_progress' => $callback];
        }

        return $this->sendEvent($url, $data);
    }

    private function formatUrl(string $eventName, EventData $eventData): array
    {
        $params = [];
        $url = $this->config['gtm_server_domain'] . $this->config['request_path'];
        $queryString = \parse_url($url, PHP_URL_QUERY);
        if ($queryString) {
            \parse_str($queryString, $params);
        }

        $params['v'] = $this->config['protocol_version'];
        $params['event_name'] = \urlencode($eventName);

        if ($this->config['richsstsse']) {
            $params['richsstsse'] = '';
        }

        $url = $url . "?" . \http_build_query($params);

        $postData = [
            'event_name' => $eventName,
            'v' => $this->config['protocol_version'],
        ];

        $postData = ['body' => \array_merge($postData, $eventData->getData())];

        return ['url' => $url, 'postData' => $postData];
    }

    /**
     * @throws SGTMException
     */
    private function sendEvent(string $url, array $data): ResponseInterface
    {
        try {
            return $this->client->request('POST', $url, $data);
        } catch (\Throwable $e) {
            $response = $e->getResponse();
            $status = $response ? $response->getStatusCode() : null;

            $error = $response ? (string) $response->getContent() : null;

            throw new SGTMException($status, $error, "HTTP request failed {$status}");
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
            throw new SGTMException(message: 'You did not fill in the variable gtm_server_domain. Example: https://gtm.stape.io');
        }
        if (
            !isset($this->config['request_path']) ||
            !preg_match('/\//', $this->config['request_path'])
        ) {
            throw new SGTMException(message: 'You did not fill in the variable request_path. Example: /');
        }
    }
}
