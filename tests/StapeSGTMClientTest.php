<?php

namespace Stape\Tests;

use PHPUnit\Framework\TestCase;
use Stape\Sgtm\SGTMException;
use Stape\Sgtm\StapeSGTM;
use Stape\Sgtm\StapeSGTMClient;
use Stape\Sgtm\Transforms;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class StapeSGTMClientTest extends TestCase
{
    public function testCreateClient(): void
    {
        $client = StapeSGTM::create('https://gtm.stape.io');

        $this->assertInstanceOf(StapeSGTMClient::class, $client);
    }

    public function testCreteWrongClient(): void
    {
        $this->expectException(SGTMException::class);
        StapeSGTM::create('http://gtm.stape.io');
    }

    public function testSendRequest(): void
    {
        $mock = new MockHttpClient(
            new MockResponse('test', ['http_code' => 200])
        );

        $requestPath = '/data';
        $protocolVersion = 2;

        $client = new StapeSGTMClient(
            $mock,
            'https://gtm.stape.io',
            $requestPath,
            false,
            $protocolVersion
        );
        $response = $client->sendEventData('page_view', [
            'client_id' => '123456',
            'currency' => 'USD',
            'ip_override' => '79.144.123.69',
            'language' => 'en',
            'page_encoding' => 'UTF-8',
            'page_hostname' => 'Stape',
            'page_location' => 'http://stape.io',
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $url = $response->getInfo()['url'];
        $urlParsed = parse_url($url);
        $this->assertEquals($requestPath, $urlParsed['path']);

        parse_str($urlParsed['query'], $urlParams);
        $this->assertEquals($protocolVersion, $urlParams['v']);

    }

}
