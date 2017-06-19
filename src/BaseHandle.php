<?php

namespace ThreeFrame;

class BaseHandle
{
    private $code = 200;
    private $data = "";
    private $contentType = "json";

    /**
     * 根据不同content-type设定不同header头并且输出
     */
    public function __destruct()
    {
        Response::$contentType = $this->contentType;
        Response::write($this->code, $this->data);
    }

    public function respJson($code, $data)
    {
        $this->contentType = "json";
        $this->code = $code;
        $this->data = $data;
    }

    public function respHtml($code, $html)
    {
        $this->contentType = "html";
        $this->code = $code;
        $this->data = $html;
    }

    public function respXml($code, $xml)
    {
        $this->contentType = "xml";
        $this->code = $code;
        $this->data = $xml;
    }
}