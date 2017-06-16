<?php

namespace ThreeFrame;

class Http
{
    private $serv;

    public function __construct($config)
    {
        $this->serv = new \swoole_http_server($config["address"], $config['port']);
        if(isset($config['user']))
        {
            $this->serv->set(["user"=>$config['user']]);
        }
        if(isset($config['group']))
        {
            $this->serv->set(["group"=>$config['group']]);
        }
        $this->serv->set(array(
            'worker_num' => $config["worker_num"],
            'daemonize' => $config["daemon"],
            'log_level' => $config["log_level"],
            'pid_file' => getcwd().$config['pid_file'],
            'log_file' => getcwd().$config['log_file'],
        ));
    }

    public function onRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        Request::Init($request);
        Response::Init($response);
        Router::dispatch();
    }

    public function run()
    {
        $this->serv->on('Request', array($this, 'onRequest'));
        $this->serv->start();
    }
}