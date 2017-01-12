<?php

/**
 * Copyright (c) 2013 Milq Media (https://github.com/milqmedia)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 *
 * @author Milq Media <johan@milq.nl>
 *
 */

namespace MQRedisSessionStorage\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use MQRedisSessionStorage\Storage\RedisStorage;

/**
 * Class RedisStorageFactory
 * @package MQRedisSessionStorage\Factory
 */
class RedisStorageFactory implements FactoryInterface
{
    /**
     * @param \Zend\ServiceManager\ServiceManager $container
     * @param string $requestedName
     * @param array|NULL $options
     * @return RedisStorage
     */
    public function __invoke($container, $requestedName, array $options = NULL)
    {
        $conf = $container->get('Config');
        $config = null;
        if (isset($conf['mq-redis-session'])) {
            $config = $conf['mq-redis-session'];
        }

        return new RedisStorage($config);
    }

    /**
     * @param ServiceLocatorInterface $services
     * @return RedisStorage
     */
    public function createService(ServiceLocatorInterface $services)
    {
        return $this($services, 'MQRedis');
    }
}