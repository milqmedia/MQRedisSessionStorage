MQRedisSessionStorage
================

Zend Framework Module for storing sessions in Redis.

## Features
- Redis SessionSaveHandler support
- Uses Zend\Cache\StorageFactory
- Easy session configuration

## Setup

  1. Run `php composer.phar require milqmedia/mq-redis-session:dev-master`
  2. Add `MQRedisSessionStorage` to the enabled modules list
  3. Copy `vendor/milqmedia/mq-redis-session/redissession.global.php.dist` to `config/autoload/redissession.global.php` 
  4. Configure the session options in `config/autoload/redissession.global.php`
  5. Session storage will be set by default. For more control set "set_storage_on_boot" to false in your config file and add the lines below in your project's main module or elsewhere:

    ```php
    $redisStorage = $sm->get('MQRedisSessionStorage\Storage\RedisStorage');
    $redisStorage->setSessionStorage();
    ```
