<?php

namespace ThreeFrame;
class Request
{
    static $request;
    static $json;

    public static function Init(\swoole_http_request $request)
    {
        self::$request = $request;
        if(Config::Get("debug"))
        {
            print sprintf( "[%s] fd:%s %s %s %s \r\n",date("Y-m-d H:i:s"),sprintf('% -10s',self::$request->fd), sprintf('% -4s',self::getMethod()),sprintf('% -18s',self::getRequestUri()),sprintf('% -10s',self::getRequestIp()));
        }

    }

    /**
     * 获取用户提交的数据
     * @param null $key
     * @param null $default
     * @return mixed|null
     */
    public static function input($key = null, $default = null)
    {
        return self::getInputSource()[$key] ?? $default;
    }

    /**
     * 获取server参数数据
     * @param null $key
     * @param null $default
     * @return null
     */
    public static function server($key = null, $default = null)
    {
        return self::$request->server[$key] ?? $default;
    }
    public static function json()
    {
        return json_decode(self::$request->rawContent(), true);
    }

    public static function get()
    {
        return self::$request->get;
    }

    public static function post()
    {
        return self::$request->post;
    }
    /**
     * 是否为ajax
     * @return bool
     */
    public static function ajax()
    {
        return self::isXmlHttpRequest();
    }
    private static function isJson()
    {
        return strpos(self::$request->header['content-type'] ?? "", "json");
    }
    private static function isPlain()
    {
        return strpos(self::$request->header['content-type'] ?? "", "plain");
    }

    /**
     * 获取Input源
     * @return array|mixed
     */
    protected static function getInputSource()
    {
        if (self::isJson()) {
            return self::json();
        }
        if (self::isPlain()) {
            return [];
        }
        return self::getMethod() == 'GET' ? self::get() : self::post();
    }

    /**
     * 获取请求方式
     * @return string
     */
    private static function getMethod()
    {
        return strtoupper(self::$request->server['request_method']);
    }
    public static function getRequestIp()
    {
        return self::$request->server['remote_addr'];
    }
    private static function getRequestUri()
    {
        return self::$request->server['request_uri'];
    }
    private static function isXmlHttpRequest()
    {
        return 'XMLHttpRequest' == self::$request->header['X-Requested-With'];
    }
}