<?php

namespace app\library\utils;

/**
 * @desc 共用的工具方法类
 * @author ibingbo
 */
class Common{

    /**
     * @desc 获取数据列表据的树型结构
     * @param $list-数据列表,$pid-item数据的父级ID，即pid
     * $list列表必须是以层级关系存储，如
     * $list = array(
     *      ['id'=>1,'name'=>'aaa','pid'=>0],
     *      ['id'=>2,'name'=>'bbb','pid'=>1],
     *      ['id'=>3,'name'=>'ccc','pid'=>2],
     *      ['id'=>4,'name'=>'ddd','pid'=>1],
     * )
     * 即数据库表设计字段有['id','name','pid']等
     * @return $result
     */
    public static function getTree(&$list, $pid = 0){
        $result = array();
        if(!empty($list)){
            foreach($list as $k => &$item){
                if($item['pid'] == $pid){
                    $item['child'] = self::getTree($list, $item['id']);
                    $result[] = $item;
                    unset($list[$k]);
                }
            }
        }
        return $result;
    }
}
