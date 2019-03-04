<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/4 0004
 * Time: 15:12
 */

if($argc < 2){
    echo "\n";
    echo "--listTube => 当前的管道列表\n";
    echo "--statsJob => 查看任务的详细信息\n";
    echo "--statsTube => 查看管道的详细信息\n";
    echo "\n";
    return ;
}

require "vendor/autoload.php";

use Pheanstalk\Pheanstalk;
$pheanstalk = Pheanstalk::create('127.0.0.1');

switch ($argv[1]){
    case '--listTube':
        $listTubes = $pheanstalk->listTubes();
        print_r($listTubes);
        break;
    /*case '--statsJob':
        if(!isset($argv[2])){
            echo "\n请加上管道名: php tools.php --statsJob default \n\n";
            return ;
        }
        $job =  $pheanstalk->watch('default')->reserve();
        $job_stats = $pheanstalk->statsJob($job);
        print_r($job_stats);
        break;*/
    case '--statsTube':
        if(!isset($argv[2])){
            echo "\n请加上管道名: php tools.php --statsTube default \n\n";
            return ;
        }
        print_r($pheanstalk->statsTube($argv[2]));
        break;
    default:

}

