<?php
require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;

//默认端口11300 ， 超时10s
$pheanstalk = Pheanstalk::create('127.0.0.1');

$data = [
    'name'=>'test',
    'time'=> date('Y-m-d H:i:s')
];

// ----------------------------------------
// producer (queues jobs)

//往tube中增加数据
//put(
//    23, // 任务的优先级.
//    0,  // 不等待直接放到ready队列中.
//    60, // 处理任务的时间.
//    'hello, beanstalk' // 任务内容
//);

$pheanstalk
    ->useTube('testtube')
    ->put(json_encode($data));

//当前管道信息
print_r($pheanstalk->statsTube('testtube'));

