<?php

namespace app\Controllers;

use Server\CoreBase\Controller;

/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午3:51
 */
class Action extends Controller
{
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
    }

    /**
     * @throws \Exception
     */
    public function onConnect()
    {
        $uid = time();
        $this->bindUid($uid);
        $this->send(['type' => 'welcome', 'id' => $uid]);
    }

    public function login()
    {

    }

    /**
     * @throws \Server\CoreBase\SwooleException
     */
    public function update()
    {
        $this->sendToAll(
            [
                'type' => 'update',
                'id' => $this->uid,
                'angle' => $this->client_data->angle + 0,
                'momentum' => $this->client_data->momentum + 0,
                'x' => $this->client_data->x + 0,
                'y' => $this->client_data->y + 0,
                'life' => 1,
                'name' => isset($this->client_data->name) ? $this->client_data->name : 'Guest.' . $this->uid,
                'authorized' => false,
            ]);
    }

    /**
     * @throws \Server\CoreBase\SwooleException
     */
    public function message()
    {
        $this->sendToAll(
            [
                'type' => 'message',
                'id' => $this->uid,
                'message' => $this->client_data->message,
            ]
        );
    }

    public function onClose()
    {

    }
}
