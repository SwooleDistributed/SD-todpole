<?php
/**
 * Created by PhpStorm.
 * User: zhangjincheng
 * Date: 16-7-15
 * Time: 下午4:49
 */
$config['mysql']['enable'] = false;

$config['mysql']['active'] = 'local';
$config['mysql']['local']['host'] = 'localhost';
$config['mysql']['local']['port'] = '3306';
$config['mysql']['local']['user'] = 'root';
$config['mysql']['local']['password'] = '123456';
$config['mysql']['local']['database'] = 'youwo_dliao';
$config['mysql']['local']['charset'] = 'utf8';
$config['mysql']['asyn_max_count'] = 10;
return $config;