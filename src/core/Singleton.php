<?php


abstract class Singleton
{
    private static $_instances = [];

    public static function getInstance(): self
    {
        $class = get_called_class();

        if (!isset(self::$_instances[$class]))
            self::$_instances[$class] = new $class();

        return self::$_instances[$class];
    }
}
