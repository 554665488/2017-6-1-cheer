<?php

/**
 * Created by PhpStorm.
 * @description:  人员查找类 给
 * 这个类不支持需要为不同数据源提供不同查找方法的多态  因此这里最好单独设置查找方法的对象。
 * @time: 2017年7月4日00:02:38
 * @Author: yfl
 * @QQ 554665488
 * Date: 2017/7/4
 * Time: 0:01
 */
require_once './Db.php';

class CustomerFinder
{
    static $findObj;

//    public function __construct()
//    {
//         if(isset(self::$findObj)){
//             return  self::$findObj;
//         }
//         self::$findObj=new Order();
//    }

    public static function find($customer_id)
    {
        $sql = "SELECT * from person  WHERE customer_id=" . $customer_id;
        $res=DB::query($sql);
        return Customer::returnObj($res);
    }
}