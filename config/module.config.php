<?php
/**
 * This file is part of the MQRedisSessionStorage Module (https://github.com/milqmedia/MQRedisSessionStorage.git)
 *
 * Copyright (c) 2013 Milq Media (https://github.com/milqmedia/MQRedisSessionStorage.git)
 *
 * For the full copyright and license information, please view
 * the file LICENSE.txt that was distributed with this source code.
 */
return array(
    'service_manager' => array(
        'factories' => array(
            'MQRedisSessionStorage\Storage\RedisStorage' => 'MQRedisSessionStorage\Factory\RedisStorageFactory',
        )
    ),

);
