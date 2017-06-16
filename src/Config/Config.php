<?php

namespace ThreeFrame;

class Config
{
    private static $configs;

    public static function Init(string $path)
    {
        if (empty(self::$configs)) {
            self::$configs = parse_ini_file($path, true);
            print "load config path " . $path . "\n";
            print json_encode(self::$configs, 256) . "\n";
        }
    }

    public static function Get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        if (isset($keys[1])) {
            return self::$configs[$keys[0]][$keys[1]] ?? self::$configs[$key] ?? $default ?? "";
        }
        return self::$configs[$key] ?? $default ?? "";
    }
}