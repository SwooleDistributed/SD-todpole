<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:11
 */

namespace Server\Route;


class MyRoute implements IRoute
{
    private $client_data;

    public function __construct()
    {
        $this->client_data = new \stdClass();
    }

    /**
     * 设置反序列化后的数据 Object
     * @param $data
     * @return \stdClass
     */
    public function handleClientData($data)
    {
        $this->client_data = $data;
        return $this->client_data;
    }

    /**
     * 处理http request
     * @param $request
     */
    public function handleClientRequest($request)
    {
        $this->client_data->path = $request->server['path_info'];
        $route = explode('/', $request->server['path_info']);
        $this->client_data->controller_name = $route[1]??null;
        $this->client_data->method_name = $route[2]??null;
    }

    /**
     * 获取控制器名称
     * @return string
     */
    public function getControllerName()
    {
        return 'Action';
    }

    /**
     * 获取方法名称
     * @return string
     */
    public function getMethodName()
    {
        return $this->client_data->type;
    }

    public function getPath()
    {
        return $this->client_data->path??null;
    }

    public function getParams()
    {
        return $this->client_data->params??null;
    }

    public function errorHandle(\Throwable $e, $fd)
    {
        //get_instance()->close($fd);
    }

    public function errorHttpHandle(\Throwable $e, $request, $response)
    {
        // TODO: Implement errorHttpHandle() method.
    }
}
