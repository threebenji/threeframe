<?php
namespace ThreeFrame;
/**
 * \View视图层
 */
class View
{
    private static $ptah = '/views/';
    public $view;
    public $data;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public static function setPath($path)
    {
        self::$ptah = $path;
    }

    /**
     * @param null $viewName
     * @param $args
     * @return string
     */
    public static function make($viewName = null,$args)
    {
        if (!$viewName) {
            throw new \InvalidArgumentException("视图名称不能为空！");
        } else {
            if (!empty($args)) {
                extract($args);
            }
            ob_start();
            include self::getFilePath($viewName);
            $content = ob_get_contents();
            ob_clean();
            return $content;
        }
    }
    /**
     * @param $viewName
     * @return string
     */
    private static function getFilePath($viewName)
    {
        $filePath = str_replace('.', '/', $viewName);
        $viewFilePath = self::$ptah . $filePath . '.php';
        if (is_file($viewFilePath)) {
            return $viewFilePath;
        }else{
            throw new \UnexpectedValueException("视图文件不存在！");
        }
    }

    /**
     * @param $viewName
     * @param array $args
     * @return string
     */
    public static function include_view($viewName, array $args = [])
    {
        if (!empty($args)) {
            extract($args);
        }
        ob_start();
        include self::getFilePath($viewName);
        $content = ob_get_contents();
        ob_clean();
        return $content;
    }
}
