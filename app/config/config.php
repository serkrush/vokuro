<?php

use Phalcon\Config;
use Phalcon\Logger;
//define('BASE_PATH', '/home/krushelnitskiy-su/projects/vokuro_test/app');

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/');

return new Config([
    'database' => [
        'adapter' => 'Mysql',
        'host' => '127.0.0.1',
        'username' => 'vokuro',
        'password' => 'vokuro',
        'dbname' => 'vokuro'
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir'      => APP_PATH . '/models/',
        'formsDir'       => APP_PATH . '/forms/',
        'viewsDir'       => APP_PATH . '/views/',
        'libraryDir'     => APP_PATH . '/library/',
        'pluginsDir'     => APP_PATH . '/plugins/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/',
        'publicUrl'      => 'vokuro.phalconphp.com',
        'cryptSalt'      => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D'
    ],
    'mail' => [
        'fromName' => 'Vokuro',
        'fromEmail' => 'phosphorum@phalconphp.com',
        'smtp' => [
            'server' => 'email-smtp.eu-west-1.amazonaws.com',
            'port' => 587,
            'security' => 'tls',
            'username' => 'AKIAJD47LRRC4R7RQ5YA',
            'password' => 'AteMlH0GBg1un2UKlrnrppQIqUggupKwK4/eIqVNkD+u'
        ]
    ],
    'amazon' => [
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    ],
    'logger' => [
        'path'     => BASE_PATH . '/logs/',
        'format'   => '%date% [%type%] %message%',
        'date'     => 'D j H:i:s',
        'logLevel' => Logger::DEBUG,
        'filename' => 'application.log',
    ],
    // Set to false to disable sending emails (for use in test environment)
    'useMail' => true
]);
