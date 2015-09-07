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
use Zend\Session\Validator\HttpUserAgent;
use Zend\Session\Validator\RemoteAddr;
use Zend\Cache\StorageFactory;

class RedisStorage
{
    protected $_config;
    protected $_manager;

    public function __construct($config)
    {
        $this->_config = $config;
    }
    
    public function getManager() {
	    return $this->_manager;
    }
    
    public function changeTtl($ttl = 0) {
	    
	    $this->_config['redis']['adapter']['options']['ttl'] = $ttl;
	    
	    $this->setSessionStorage();
    }

    public function setSessionStorage()
    {
        $cache = StorageFactory::factory($this->_config['redis']);
		
	// If database is set in the config use it		
	if(isset($this->_config['redis']['adapter']['options']['database'])) {
		$cache->getOptions()->setDatabase($this->_config['redis']['adapter']['options']['database']);
	}
		          
	$saveHandler = new Cache($cache);
		
	$manager = new SessionManager();
		
	$sessionConfig = new \Zend\Session\Config\SessionConfig();
        $sessionConfig->setOptions($this->_config['session']);
        
        $manager->setConfig($sessionConfig);        
	$manager->setSaveHandler($saveHandler);
		
	// Validation to prevent session hijacking
	$manager->getValidatorChain()->attach('session.validate', array(new HttpUserAgent(), 'isValid'));
	$manager->getValidatorChain()->attach('session.validate', array(new RemoteAddr(), 'isValid'));		       
	
	try {
		$manager->start();
	catch(Zend\Cache\Exception\InvalidArgumentException $e) {
		trigger_error('MQ-RedisSession Error: ' . $e->getMessage(), E_USER_ERROR)	
	}
		
	Container::setDefaultManager($manager);
		
	$this->_manager = $manager;
    }
}
