<?php

namespace Stape\tests;

use PHPUnit\Framework\TestCase;
use Stape\Sgtm\SGTMException;
use Stape\Sgtm\StapeSGTM;
use Stape\Sgtm\StapeSGTMClient;
use Stape\Sgtm\Transforms;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class StapeSGTMTest extends TestCase
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

		$client = new StapeSGTMClient($mock, 'https://gtm.stape.io');
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
	}

	public function testBase64(): void
	{
		$str = 'test';
		$this->assertEquals(\base64_encode($str), Transforms::base64($str));
	}

	public function testTrim(): void
	{
		$str = '   test   ';
		$this->assertEquals(\trim($str), Transforms::trim($str));
	}

	public function testSha256base64(): void
	{
		$str = 'test';
		$this->assertEquals(\hash('sha256', \strtolower(\base64_encode($str))), Transforms::sha256base64($str));
	}

	public function testSha256hex(): void
	{
		$str = 'test';
		$this->assertEquals(\hash('sha256', \strtolower($str)), Transforms::sha256hex($str));
	}

	public function testMd5(): void
	{
		$str = 'test';
		$this->assertEquals(\md5(\strtolower($str)), Transforms::md5($str));
	}

	public function testToLowerCase(): void
	{
		$str = 'TEST';
		$this->assertEquals(\strtolower($str), Transforms::toLowerCase($str));
	}
}