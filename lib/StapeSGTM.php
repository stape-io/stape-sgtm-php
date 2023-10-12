<?php

use GuzzleHttp\Exception\ClientException;

class StapeSGTM extends EventDataImpl implements StapeSGTMErroInterface
{
    private $config;
    private $curl;

    public function __construct($gtm_server_domain, $request_path = '/data', $richsstsse = false, $protocol_version = 2)
    {
        $this->config = array(
            'gtm_server_domain' => $gtm_server_domain,
            'request_path' => $request_path,
            'richsstsse' => $richsstsse,
            'protocol_version' => $protocol_version
        );

        $this->curl = new GuzzleHttp\Client();
        $this->validateConfig();
    }

    public function sendEventData($event_name, $eventData = array())
    {
        parent::__construct($eventData);
        $eventData = $this->arrayEventData();
        $result = $this->validURL($event_name, $eventData);
        $url = $result['url'];
        $postData = $result['postData'];

        return $this->goUrl($url, $postData);
    }

    private function validURL($event_name, $eventData)
    {
        $url = $this->config['gtm_server_domain'] . $this->config['request_path'];
        $queryString = parse_url($url, PHP_URL_QUERY);
        parse_str($queryString, $params);

        $params['v'] = $this->config['protocol_version'];
        $params['event_name'] = urlencode($event_name);

        if ($this->config['richsstsse']) {
            $params['richsstsse'] = '';
        }

        $url = $url . "&" . http_build_query($params);

        $postData = array(
            'event_name' => $event_name,
        );

        $postData = array('form_params' => array_merge($postData, $eventData));

        return array('url' => $url, 'postData' => $postData);
    }

    private function goUrl($url, $postData)
    {
        try {
            $response = $this->curl->request('POST', $url, $postData);
            $response->getStatusCode();
            $response->getHeaders();
            $body = $response->getBody();
            return $body->getContents();
        } catch (ClientException $e) {
            $response = $e->getResponse();
            $status = $response ? $response->getStatusCode() : null;
            $statusText = $response ? $response->getReasonPhrase() : null;

            $error = $response ? (string) $response->getBody() : null;

            throw new CustomHttpError($status, $statusText, $error, "HTTP request failed {$status}");
        }
        return $response;
    }

    public function validateConfig()
    {
        if (
            !isset($this->config['gtm_server_domain']) ||
            !preg_match('/^https:\/\//', $this->config['gtm_server_domain']) ||
            preg_match('/^\//', $this->config['gtm_server_domain'])
        ) {
            throw new CustomHttpError('', '', '', 'You did not fill in the variable gtm_server_domain. Example: https://gtm.stape.io');
        }
        if (
            !isset($this->config['request_path']) ||
            !preg_match('/\//', $this->config['request_path'])
        ) {
            throw new CustomHttpError('', '', '', 'You did not fill in the variable request_path. Example: /');
        }
    }
}
