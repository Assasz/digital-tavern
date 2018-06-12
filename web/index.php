<?php
define('BASE_URL', 'http://localhost/digitaltavern/web/');
define('DEBUG', false);

if(!DEBUG) {
    ini_set('display_errors', 0);
}

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use DigitalTavern\Infrastructure\Config\AppConfiguration;
use Yggdrasil\Core\Kernel;

$appConfiguration = new AppConfiguration();
$kernel = new Kernel($appConfiguration);

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();