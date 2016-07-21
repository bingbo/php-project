<?php

namespace app\library\core;

/**
 * @desc 工厂类，创建并保存所有的实例对象
 * @author ibingbo.zh@gmail.com
 */
class Factory{
    
    private static $instances = array();

    public static function create($cls = '', $args = array()){
        if(empty($cls)){
            return null;
        }
        if(empty(self::$instances[$cls])){
            $class = new \ReflectionClass($cls);
            self::$instances[$cls] = $class->newInstanceArgs($args);
        }
        return self::$instances[$cls];
    }
}
