# Stape sGTM PHP SDK

## Getting Started

### Configuration

Fill in the basic parameters:

```php
use Stape\Sgtm\StapeSGTM;

$sgtm = StapeSGTM::create('https://gtm.stape.io', '/data');
```

| Variable         | Description             |
|------------------|-------------------------|
| $gtmServerDomain | Server host             |
| $requestPath     | Request processing path |


### Sending Event Data

```php
$sgtm->sendEventData(<$eventName>, <$eventData>);
```

| Variable   | Description                             |
|------------|-----------------------------------------|
| $eventName | Event name                              |
| $eventData | Array of options for forming event data |


**$eventData**

```php
$eventData = [
  'page_hostname' => 'Stape',
  'page_location' => 'http://stape.io',
  'page_path' => '/',
  'user_data' => [
    'sha256_email_address' => Transforms::sha256hex('jhonn@doe.com'),
    'address' => [
      'first_name' => 'Jhon',
    ],
  ],
];
```

####  Transforms

| Option       | Description                                                |
|--------------|------------------------------------------------------------|
| trim         | Removes whitespace from the beginning and end of the value |
| base64       | Encodes the string in Base64 format                        |
| md5          | Encodes the string in MD5 format                           |
| sha256base64 | Encodes the string in SHA256 Base64 format                 |
| sha256hex    | Encodes the string in SHA256 HEX format                    |


### Full Example

```php
namespace Stape\Sgtm\Example;

use Stape\Sgtm\StapeSGTM;
use Stape\Sgtm\Transforms;

require_once __DIR__  . '/../vendor/autoload.php';

$start = StapeSGTM::create('https://gtm.stape.io', '/data?dhjdf=123');

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
```
