<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 15:03
 * @author: yfl
 * @QQ: 554665488
 * @description:
 * @time:
 */
class DB
{
    /**
     * @author: yfl
     * @QQ: 554665488
     * @description:  这只是一个执行SQL的演示方法
     * @time:
     * @param $sql  需要执行的SQL
     * @return array
     */
    public static function query($sql)
    {
        echo '执行的SQL====='.$sql;
        if(stripos($sql,'select') !== false){

            return array('id' => 1, 'name' => 'Martin', 'birthday' => '2010-09-15');
        }
    }
}