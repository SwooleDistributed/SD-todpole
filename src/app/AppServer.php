<?php
namespace app;

use Server\Asyn\HttpClient\HttpClientPool;
use Server\Asyn\Redis\RedisAsynPool;
use Server\Asyn\TcpClient\SdTcpRpcPool;
use Server\SwooleDistributedServer;
use Server\SwooleServer;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-9-19
 * Time: 下午2:36
 */
class AppServer extends SwooleDistributedServer
{
    /**
     * 开服初始化(支持协程)
     * @return mixed
     */
    public function onOpenServiceInitialization()
    {
        yield parent::onOpenServiceInitialization();
        if(version_compare(SwooleServer::version, '2.1.3') < 0){
            var_dump("请使用2.1.3版本");
        }
    }

    /**
     * ws开始连接
     * @param $server
     * @param $request
     */
    public function onSwooleWSOpen($server, $request)
    {
        //转发到控制器处理
        $this->onSwooleWSAllMessage($server,$request->fd,$this->pack->pack(['type' => 'connect']));
    }

    /**
     * 当一个绑定uid的连接close后的清理
     * 支持协程
     * @param $uid
     */
    public function onUidCloseClear($uid)
    {
        // TODO: Implement onUidCloseClear() method.
    }

    /**
     * 这里可以进行额外的异步连接池，比如另一组redis/mysql连接
     * @param $workerId
     * @return array
     */
    public function initAsynPools($workerId)
    {
        parent::initAsynPools($workerId);
        //都是测试的，实际应用中可以删除
        $this->addAsynPool('DingDingRest', new HttpClientPool($this->config, $this->config->get('dingding.url')));
        $this->addAsynPool('RPC', new SdTcpRpcPool($this->config, 'test', "192.168.8.48:9093"));
        $this->addAsynPool('redis_local2', new RedisAsynPool($this->config, "local2"));
        //redis根据key进行自动路由
        //RedisRoute::getInstance()->addRedisPoolRoute('testroute', 'redis_local2');
    }
}