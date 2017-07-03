<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 11:27
 * @author: yfl
 * @QQ: 554665488
 * @description:  数据源结构模式 ----表入口模式
 * @time: 2017年7月3日 12:37:46
 */
require_once './table.php';

class person extends databaseTable
{
    public $instance;

    public $table = 'mj_user';

    public function __construct()
    {
        $this->instance = person::getInstance();
    }

    public function getPersonById($personId)
    {
        var_dump($this->instance);
        $sql = "select * from $this->table WHERE id={$personId}";
        return $this->instance->query($sql);
    }
    ///**其他的一些增删改查操作方法...**/

}