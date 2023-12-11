<?php

namespace Stape\Sgtm;

use Symfony\Component\HttpClient\HttpClient;

class StapeSGTM
{
    public static function create(
        string $gtmServerDomain,
        string $requestPath = '/data',
        bool   $richsstsse = false,
        int    $protocolVersion = 2,
    ): StapeSGTMClient {
        $client = HttpClient::create();
        return new StapeSGTMClient($client, $gtmServerDomain, $requestPath, $richsstsse, $protocolVersion);
    }
}
