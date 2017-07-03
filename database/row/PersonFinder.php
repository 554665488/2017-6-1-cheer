<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 15:29
 * @author: yfl
 * @QQ: 554665488
 * @description:  人员查找类
 * @time:
 */
require_once './Db.php';
require_once './PersonGateway.php';

/**
 * @author: yfl
 * @QQ: 554665488
 * @description:   人这个类的查找功能类 抽象类
 * @time:  2017年7月3日 16:33:31
 * Class PersonFinder
 */
  class PersonFinder
{
    /**
     * @author: yfl
     * @QQ: 554665488
     * @description:  静态方法获取一个对象实例
     * @time: 2017年7月3日 16:34:05
     * @param $id
     * @return PersonGateway
     */
    static public function find($id)
    {
        $sql = "SELECT * FROM person WHERE id = " . $id;
        $rs = DB::query($sql);

        return PersonGateway::load($rs);  //返回的是

    }

    /**
     * @author: yfl
     * @QQ: 554665488
     * @description:  静态方法获取所有的实例
     * @time:  2017年7月3日 16:34:27
     * @return array
     */
    static public function findAll()
    {
        $sql = "SELECT * FROM person";
        $rs = DB::query($sql);
        $result = array();
        if (is_array($rs)) {

            foreach ($rs as $index => $r) {
                $result[]=PersonGateway::load($r);
            }
        }
        return $result;//返回的是一个对象数组
    }
}