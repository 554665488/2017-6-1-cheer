<?php
/**
 * Created by PhpStorm.
 * User: yfl
 * QQ 554665488
 * Date: 2017/7/3
 * Time: 22:44
 */

/**
 * @description: 企业应用架构 数据源架构模式之活动记录
 * @time: 2017-7-3 22:48:04
 * @Author: yfl
 * @QQ 554665488
 * Class Order  订单类
 */
require_once "../row/Db.php";

class Order
{
    private $_order_id; //订单ID
    private $_customer_id;//客户ID
    private $_amount;//订单金额

    public function __construct($order_id, $customer_id, $amount)
    {
        $this->_order_id = $order_id;
        $this->_customer_id = $customer_id;
        $this->_amount = $amount;
    }

    /**
     * @description: 用户实例删除的操作
     * @time: 2017年7月3日22:57:23
     * @Author: yfl
     * @QQ 554665488
     * @return array
     */
    public function delete()
    {
        $sql = "DELETE FROM Order_table SET WHERE order_id=" . $this->_order_id . "AND customer_id=" . $this->_customer_id;
        return DB::query($sql);
    }

    /**
     * @description: 用户实例的更新操作
     * @time:  2017年7月3日23:06:59
     * @Author: yfl
     * @QQ 554665488
     * @return array
     */
    public function update()
    {
        $sql = "UPDATE Order_table SET  `order_id`=$this->_order_id,`customer_id`=$this->_customer_id,`amount`=$this->_amount WHERE `customer_id`=$this->_customer_id";
        return DB::query($sql);
    }

    /**
     * @description: 插入操作
     * @time: 2017年7月3日23:09:14
     * @Author: yfl
     * @QQ 554665488
     * @return array
     */
    public function insert()
    {
        $data = array('order_id' => $this->_order_id, 'customer_id' => $this->_customer_id, 'amount' => $this->_amount);

        $sql = "insert into Order_table";

        $sql .= "(`" . implode("`,`", array_keys($data)) . "`)";

        $sql .= "VALUES('" . implode("','", array_values($data)) . "')";
        return DB::query($sql);
    }

    /**
     * @description:  返回一个活动对象模型实例记录
     * @time: 2017年7月3日23:14:11
     * @Author: yfl
     * @QQ 554665488
     * @param $res
     * @return Order
     */
    public static function returnObj($res)
    {
        return new Order($res['order_id'] ? $res['order_id'] : null, $res['customer_id'], $res['amount']?$res['amount']:0);
    }
}