<?php
//数据源架构模式 表入口 行入口 活动记录 数据映射器

//数据源结构模式 ----表入口模式

/**
 * @author: yfl
 * @QQ: 554665488
 * @description:  数据库连接抽象类
 * @time: 2017年7月3日 11:28:58
 * Class databaseTable
 */
abstract class databaseTable
{
    private static $_dbConfig = array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'pwd' => '123456',
        'dbname' => 'tp5'
    );
    private static $_instance;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new mysqli(self::$_dbConfig['host'], self::$_dbConfig['username'], self::$_dbConfig['pwd'], self::$_dbConfig['dbname']);
            if (self::$_instance->error) {
                throw  new Exception(self::$_instance->error);
            }
        }
        return self::$_instance;
    }

}