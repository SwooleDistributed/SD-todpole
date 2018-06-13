<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-14
 * Time: 下午1:58
 */

use Server\CoreBase\PortManager;

$config['ports'][] = [
    'socket_type' => PortManager::SOCK_WS,
    'socket_name' => '0.0.0.0',
    'socket_port' => 8081,
    'route_tool' => 'MyRoute',
    'pack_tool' => 'NonJsonPack',
    'opcode' => PortManager::WEBSOCKET_OPCODE_TEXT,
    'middlewares' => ['MonitorMiddleware', 'NormalHttpMiddleware']
];

return $config;