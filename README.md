swoole多进程处理beanstalkd队列


### ubuntu上安装beanstalkd服务，

> sudo apt-get install beanstalkd

beanstalk  /etc/init.d/beanstalkd start

./beanstalkd -l 127.0.0.1 -p 11300  -b /data/beanstalkd/binlog &

-b表示开启binlog，断电后重启自动恢复任务

ps -ef | grep beanstalkd 查看是否开启


### 安装pheanstalk

通过composer安装 composer require pda/pheanstalk

### 安装swoole

参考：https://wiki.swoole.com/wiki/page/6.html



