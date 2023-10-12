<?php

require 'vendor/autoload.php';
require 'lib/StapeSGTMErroInterface.php';
require 'lib/AddressImpl.php';
require 'lib/UserDataImpl.php';
require 'lib/EventDataImpl.php';
require 'lib/StapeSGTMErro.php';
require 'lib/StapeSGTM.php';

$start = new StapeSGTM('https://gtm.stape.io', '/data?dhjdf=123');

$eventData = array(
    'client_id' => '123456',
    'currency' => 'USD',
    'ip_override' => '79.144.123.69',
    'language' => 'en',
    'page_encoding' => 'UTF-8',
    'page_hostname' => 'Stape',
    'page_location' => 'http://stape.io',
    'page_path' => '/',
    'user_data' => array(
        'sha256_email_address' => hash('sha256', 'jhonn@doe.com'),
        'phone_number' => '123456769',
        'address' => array(
            'first_name' => 'Jhon',
        ),
    ),
);

var_dump($start->sendEventData('page_view', $eventData));