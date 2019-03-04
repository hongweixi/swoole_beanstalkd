<?php

require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;


// ----------------------------------------
// worker (performs jobs)

$workerNum = 10;  //进程数
$pool = new Swoole\Process\Pool($workerNum);

$pool->on("WorkerStart", function ($pool, $workerId) {
    echo "Worker#{$workerId} is started\n";
    $pheanstalk = Pheanstalk::create('127.0.0.1');
    while(true){
//        file_put_contents("log.log", "[".time()."] \n", FILE_APPEND);

        $job = $pheanstalk
            ->watch('testtube')
            ->ignore('default')
            ->reserve();
        $data = json_decode($job->getData());
        if($data){
            try{
                print_r($data);
                handle($data);

                $pheanstalk->delete($job);
            }catch (Exception $e){
                $pheanstalk->release($job);
            }
        }
    }

});

$pool->on("WorkerStop", function ($pool, $workerId) {
    echo "Worker#{$workerId} is stopped\n";
});

$pool->start();




//逻辑代码
function handle($data){
    for($i=0;$i<10000000;$i++){

    }
//    file_put_contents("log.log", "[".time()."] : ".json_encode($data)."\n", FILE_APPEND);
}





