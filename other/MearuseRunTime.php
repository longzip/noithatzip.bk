<?php
class other_MearuseRunTime
{
    public static function start()
    {
        self::$timing = microtime(TRUE);
    }
    
    
    public static function end()
    {
        self::$timing = microtime(TRUE) - self::$timing;
        return self::$timing;
    }
    public static $timing = 0;
}