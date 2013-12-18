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

namespace MQRedisSessionStorage\Storage;

use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Session\SaveHandler\Cache;
use Zend\Cache\StorageFactory;

class RedisStorage
{
    protected $redisConfig;

    public function __construct($redisConfig)
    {
        $this->redisConfig = $redisConfig;
    }

    public function setSessionStorage()
    {
        $cache = StorageFactory::factory($this->redisConfig);
		
		$saveHandler = new Cache($cache);
		
		$manager = new SessionManager();
		$manager->setSaveHandler($saveHandler);
        
		$manager->start();
    }
}
