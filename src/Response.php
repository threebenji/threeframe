<?php

namespace ThreeFrame;
class Response
{
    static $response;
    static $contentType = "json";
    private static $contentTypeArray = [
        "json"=>"text/json; charset=utf-8",
        "html"=>"text/html; charset=utf-8",
        "xml"=>"text/xml; charset=utf-8",
        "plain"=>"text/plain; charset=utf-8",

    ];
    public static function Init(\swoole_http_response $response)
    {
        self::$response = $response;
    }

    /**
     * 输出内容到页面
     * @param int $code
     * @param $data
     */
    public static function write($code = 200,$data)
    {
        self::$response->status($code);
        self::$response->header("Content-Type", self::$contentTypeArray[self::$contentType]);
        if (!is_string($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        self::$response->end($data);
    }
}