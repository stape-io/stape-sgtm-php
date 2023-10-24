<?php

namespace Stape\Sgtm\Example;

use Stape\Sgtm\StapeSGTM;
use Stape\Sgtm\Transforms;

require '../vendor/autoload.php';

$start = new StapeSGTM('https://gtm.stape.io', '/data?dhjdf=123');

$eventData = [
    'client_id' => '123456',
    'currency' => 'USD',
    'ip_override' => '79.144.123.69',
    'language' => 'en',
    'page_encoding' => 'UTF-8',
    'page_hostname' => 'Stape',
    'page_location' => 'http://stape.io',
    'page_path' => '/',
    'user_data' => [
        'sha256_email_address' => Transforms::sha256hex('jhonn@doe.com'),
        'phone_number' => '123456769',
        'address' => [
            'first_name' => 'Jhon',
        ],
    ],
];

var_dump($start->sendEventData('page_view', $eventData));