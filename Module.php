<?php

/**
 * This file is part of the MQRedisSessionStorage Module (https://github.com/milqmedia/MQRedisSessionStorage.git)
 *
 * Copyright (c) 2013 Milq Media (https://github.com/milqmedia/MQRedisSessionStorage.git)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 */

namespace MQRedisSessionStorage;

/**
 * Class Module
 * @package MQRedisSessionStorage
 */
class Module
{
    /**
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
        $config = $e->getApplication()->getConfig();  
        
        if($config['mq-redis-session']['set_storage_on_boot'] === true) {
        
            $storage = $e->getApplication()->getServiceManager()->get('MQRedisSessionStorage\Storage\RedisStorage');
            
            try {
                $storage->setSessionStorage();
            } catch(\Zend\Cache\Exception\InvalidArgumentException $e) {
                // Todo: Need to do some logging one time over here
            }
        }
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }
}
