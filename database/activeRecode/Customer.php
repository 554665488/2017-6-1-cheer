<?php
/**
 * Created by PhpStorm.
 * @description:
 * @time:
 * @Author: yfl
 * @QQ 554665488
 * Date: 2017/7/3
 * Time: 23:16
 */

/**
 * @description: 用户对象控制器  活动记录的意图  一个对象，
 * @time: 2017年7月3日23:17:25
 * @Author: yfl
 * @QQ 554665488
 * Class Customer
 */
require_once './Order.php';
require_once './CustomerFinder.php';

class Customer
{
    private static $instanter;
    private $_name;  //用户名字
    private $_customer_id;  //用户ID

    public function __construct($name, $customer_id)
    {
        $this->_name = $name;
        $this->_customer_id = $customer_id;
    }

    /**
     * @description: 用户删除订单的操作 此实例的方法包含了业务逻辑
     * 通过调用单实例实现
     * 假设此处是对应的删除操作（实际中可能是以一种字段来标记假删除操作）
     * @time:
     * @Author: yfl
     * @QQ 554665488
     * @param $order_id
     * @return array
     */
    public function deleteOrder($order_id)
    {
        $orderObj = Order::returnObj(array('order_id' => $order_id, 'amount' => $this->_name, 'customer_id' => $this->_customer_id));
        return $orderObj->delete();
    }

    /**
     * @author: yfl
     * @QQ: 554665488
     * @description:  入口类自身拥有更新的操作(比如跟新状态)
     * @time: 2017-7-4 10:05:03
     * @param $order_id
     * @return array
     */
    public function update($order_id)
    {
        $orderObj = Order::returnObj(array('order_id' => $order_id, 'amount' => $this->_name, 'customer_id' => $this->_customer_id));
        return $orderObj->update();
    }

    /**
     * @description: 用户实例去创造一个订单记录 添加到数据库  入口类自身拥有插入操作
     * @time:2017年7月3日23:45:15
     * @Author: yfl
     * @QQ 554665488
     * @param $order_id
     * @return array
     */
    public function insert($order_id)
    {
        $orderObj = Order::returnObj(array('order_id' => $order_id, 'amount' => $this->_name, 'customer_id' => $this->_customer_id));
        return $orderObj->insert();
    }

    /**
     * @description: 返回用户类的实例  加上了缓存  返回的是一个人员对象
     * @time: 2017年7月3日23:55:21
     * @Author: yfl
     * @QQ 554665488
     * @param $res
     * @return bool|mixed
     */
    public static function returnObj($res)
    {
        static $objCache = array();
        if (isset($objCache[$res['customer_id']])) {
            return $objCache[$res['customer_id']];
        } else {
            $obj = new Customer($res['name'], $res['customer_id'] ? $res['customer_id'] : null);  // 1:由数据行构造一个活动记录实例;2为将来对表的插入构造一个新的实例
            return $objCache[$res['customer_id']] = !empty($obj);
        }
    }

    /**
     * @author: yfl
     * @QQ: 554665488
     * @description:  用户实例去查找订单
     * @time:
     * @param $customer_id 用户ID
     * @return array
     */
    public static function find($customer_id)
    {
         return CustomerFinder::find($customer_id);
    }
    //这里还没想好怎么写
//    public static function getOrderByOrderId($orderId)
//    {
//        static $orderObjCache = array();
//        if (isset($orderObjCache[$orderId])) {
//            return $orderObjCache[$orderId];
//        }
//
//    }
}