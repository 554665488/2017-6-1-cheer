<?php
/**
 * Created by PhpStorm.
 * User: yfl
 * QQ 554665488
 * Date: 2017/7/3
 * Time: 22:44
 */

/**
 * @description: 企业应用架构 数据源架构模式之活动记录==它包装数据表或视图中某一行，(===封装数据库访问===)，并在这些数据上增加了领域逻辑。////  订单类的模型
 * @time: 2017-7-3 22:48:04
 * @Author: yfl
 * @QQ 554665488
 * Class Order  订单类
 */
require_once "./Db.php";

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

    function __set($name, $value)
    {
        // TODO: Implement __set() method.
        return $this->$name=$value;
    }

    function __get($name)
    {
        return $this->$name;
        // TODO: Implement __get() method.
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
     * @description: 插入操作  入口类自身拥有插入操作
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
//总结  该类 为一个活动记录示例
//1:活动记录的意图  === 一个对象它包装了数据表或视图的某一行，封装了数据库访问。并且在这些数据上增加了领域逻辑。
//2: 活动记录的适用场景  === 适合不太复杂的领域逻辑 如CURD操作
//3: 活动记录的运行机制  ===  对象既有数据又有行为，是将数据访问置于领域对象中
     //活动记录的本质就是一个领域模型 这里领域模型中的类和基数据库的记录结构完全匹配，类的每一个列对应着每一个域


//一般来讲  活动记录包括以下方法
//1:由数据行创建一个活动记录的实例
//2:为将来对表的插入构造一个新的实例
//3 :用静态的方法来包装SQL查询和返回活动记录
//4: 跟新数据库并将活动的记录中的数据插入到数据库
//5：获取和设置域
//6：实现简单的业务逻辑

//活动记录的优缺点
//优点

  //1:简单容易创建并容易理解
  //2:在使用事务脚本时 减少代码的复制
  //3:可以在改变数据库结构时不改变领域逻辑  (没有理解)
  //4:给予单个单个活动记录的派生和测试验证会很有效  (没有理解)


// 缺点
   //1:没有隐藏关系数据库的存在。
   //2:仅当活动记录对象和数据库表直接对应时 活动记录才有效 (没有理解)
   //3、要求对象的设计和数据库的设计紧耦合，这使得项目中的进一步重构很困难 (没有理解)



//活动记录与其它模式的区别
//数据源架构模式之行数据入口：活动记录与行数据入口十分类似。二者的主要差别是行数据入口 仅有数据库访问而活动记录既有数据源逻辑又有领域逻辑。



