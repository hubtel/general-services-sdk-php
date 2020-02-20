# HUBTEL GENERAL SERVICES SDK PHP

## Introduction 
This is a Framework for building Ussd applications in PHP against the [Hubtel Programmable Services](https://developers.hubtel.com/reference#sample-general-services-interaction).

This project is ported from the [original C# version](https://github.com/hubtel/ussd-framework) and [USSD Framework in PHP](https://github.com/McAngelo/php-ussd-framework).

## Purpose
There are ways to integrate with the [Hubtel Programmable Services](https://developers.hubtel.com/reference#sample-general-services-interaction) across programming languages. This project is particularly to integrate with PHP.

## Specifications 

- Application configuration settings
- PHP object oriented architecture
- Session storage Redis store or any RDMS
- Standards for development

## Installation

**1 Require Composer** 
PHP General Services Framework https://github.com/hubtel/general-services-sdk-php can smoothly run on newer PHP versions. The Hubtel Programmable Services PHP SDK can be installed with Composer. Run this command:

```bash
$ composer require hubtel-gh/general-services-sdk-php
```
#OR Clone the repository unto your machine/server, then navigate into the project.

**2 Create Session Storage with Redis or any RDMS**
For Redis, Create a Redis Store implementing \HubtelUssdFramework\SessionStore, Configure accordingly.

```php
'scheme' => '',
'host'   => '',
'port'   => ''

```

**3 Define the applications settings and in Index.php file**
```php
Ussd::process('logger file', 'RedisStore', 'USSDApp', 'USSDMain', 'Main startup method/action for the USSD('start')', 'server');

USSDApp - # the folder that contains all your ussd applications logic
USSDMain - # the main controller/class of your ussd logic
start - # the main action/function/method of your ussd logic 
storageType - # RedisStore
'./general.log' - # path to your logger file
```
Sample 

```bash
    Ussd::process('./general.log', new RedisStore(), 'USSDApp', 'USSDMain', 'start', $_ENV['SERVER']);
```

## Usage
Run the script using the following command
```bash
$ php -S (Server address)
```
## Demo 
```php
...
    
    # Main startup method/action for the USSD initiates the USSD session
    public function start()
    {
        $menu = new \UssdFramework\UssdMenu();
        $menu->header($this->_header)
                ->createAndAddItem('List Items', 'list_items')
                ->createAndAddItem('Exit', 'close', 'Main');
        return $this->renderMenu($menu);
    }

     public function list_items()
    {$menuHeader = 'Menu Header';

        $menu = new \UssdFramework\UssdMenu();
        $menu->header($menuHeader)
                ->createAndAddItem('Sunday', 'e_menu')
                ->createAndAddItem('Monday', 'e_menu')
                ->createAndAddItem('Tuesday', 'e_menu')
                ->createAndAddItem('Wednesday', 'e_menu')
                ->createAndAddItem('Thurday', 'e_menu')
                ->createAndAddItem('Friday', 'e_menu')
                ->createAndAddItem('Saturday', 'e_menu')
                ->addItem(new \UssdFramework\UssdMenuItem('0', 'Back', 'e_menu'));

        return $this->renderMenu($menu);
    }

    # display the menu
    public function e_menu(){

        return $this->redirect('start');
    }

     # Close user's USSD session
    public function close()
    {
        # closing message
        $message = "$this->_header \n\nThank you for using our USSD service";
        return $this->render($message);
    }
...

```



## Development Environment Setup
1. Install [Docker](https://hub.docker.com)
2. Run Redis Docker Image
```bash
$ docker run -d -p 6379:6379 --name redis1 redis
```
3. Resources
* [Redis](https://packagist.org/packages/predis/predis)
