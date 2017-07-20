<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-14
 * Time: 下午1:58
 */
/**
 * timerTask定时任务
 * （选填）task名称 task_name
 * （选填）model名称 model_name  task或者model必须有一个优先匹配task
 * （必填）执行task的方法 method_name
 * （选填）执行开始时间 start_time,end_time) 格式： Y-m-d H:i:s 没有代表一直执行,一旦end_time设置后会进入1天一轮回的模式
 * （必填）执行间隔 interval_time 单位： 秒
 * （选填）最大执行次数 max_exec，默认不限次数
 * （选填）是否立即执行 delay，默认为false立即执行
 */
//dispatch发现广播，实现集群的实现
$config['timerTask'][] = [
    'task_name' => 'UdpDispatchTask',
    'method_name' => 'send',
    'interval_time' => '30'
];
return $config;