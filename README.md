# HUBTEL GENERAL SERVICES SDK PHP

## Introduction 
This is a simple Framework for building Ussd applications in PHP against the [Hubtel Programmable Services](https://developers.hubtel.com/reference#sample-general-services-interaction).

This project is ported from the [original C# version](https://github.com/hubtel/ussd-framework) and [USSD Framework in PHP](https://github.com/McAngelo/php-ussd-framework).

## Purpose
There are ways to integrate with the [Hubtel Programmable Services](https://developers.hubtel.com/reference#sample-general-services-interaction) across programming languages. This project is particularly to integrate with PHP.

Take your time to understand how Hubtel Programmable Services works. https://developers.hubtel.com/reference#general-services

## Main specs

- Designed with PHP's object oriented architecture
- Simple application configuration settings
- Session storage Redis store or any RDMS
- Simple standards for development
- Use of [HTTPFul](http://phphttpclient.com/) for making API request

## Installation

**1 Require Composer** 
PHP General Services Framework (https://github.com/hubtel/general-services-sdk-php) can smoothly run on newer PHP versions. The Hubtel Programmable Services PHP SDK can be installed with Composer. Run this command:

```bash
$ composer require hubtel-gh/general-services-sdk-php
```
#OR Clone the repository unto your machine/server, then navigate into the project.

**2 Create Session Storage with Redis**
Implements Redis Store from \HubtelUssdFramework\SessionStore, Configure accordingly.

'scheme' => $_ENV[''],
'host'   => $_ENV[''],
'port'   => $_ENV['']

**3 Define the applications settings and in Index.php file**
```php
Ussd::process('logger file', 'RedisStore', 'USSDApp', 'USSDApp', 'Main startup method/action for the USSD('start')', 'server');

USSDApp - the folder that contains all your ussd applications logic
start - the main action/function/method of your ussd logic 
storageType -RedisStore
'./general.log' - path to your logger file
```
Sample 
```bash
    Ussd::process('./general.log', new RedisStore(), 'AppName', 'AppClassName', 'start', $_ENV['SERVER']);
```

## Usage
Run the script using the following command
```bash
$ php -S (Server address)
```

## Development Environment Setup
1. Install [Docker](https://hub.docker.com)
2. Run Redis Docker Image
```bash
$ docker run -d -p 6379:6379 --name redis1 redis
```
3. Resources
* [Redis](https://packagist.org/packages/predis/predis)