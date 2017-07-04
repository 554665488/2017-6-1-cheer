<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 15:48
 * @author: yfl
 * @QQ: 554665488
 * @description:  客户端调用  数据源架构模式之-----行数据入口之数据调用
 * @time:
 */
header("Content-type:text/html; charset=utf-8");
require_once './Db.php';
require_once './PersonGateway.php';
class Client
{
    public static function main()
    {
      //调用模型类的 写入操作
        $data=$data = array('name' => 'Martin', 'birthday' => '2010-09-15');
        $insertObj=PersonGateway::load($data); //获取的对象
        $insertObj->insert();


        //更新操作
        $data = array('id' => 1, 'name' => 'Martin', 'birthday' => '2010-09-15');

        $updateObj=PersonGateway::load($data);  //更新前获得对象 并把对象属性信息设置完成
        $updateObj->setName('Phppan');  //修改对象的属性信息
        $updateObj->update(); //修改对象信息后执行更新操作
        /**
         *查找用户实例
         */
        $findObj=new PersonFinder();
        $findObj::find(1);//获得一个对象实例
        $findObj::findAll();//获得所有的对象实例（数组对象）
    }
}
Client::main();
//总结：
//1:行数据入口是单条记录极其相识的对象  在给对象中数据库中的每一列为一个域
//2:行数据入口一般能实现从数据源类型到内存中类型的任意转换
//3:行数据入口不存在任何领域逻辑如果存在 则是活动记录
//4:在实例可以看到 为了从数据库读取信息，设置独立的personFinder类。当然这里也可以选择不新建类（可以把这个类整合到行数据入口类中 :自己理解的知道对不对）
//采用静态查找方法，但是它不支持需要为不同数据源提供不同查找的多态。因此这里最好单独设置查找方法的对象。
//5:行数据入口除了可以用于表外也可以用于视图 需要注意的视图的更新操作
//6:在代码中可见“定义元数据映射” 这是一个很好的做法 这样一来所有的数据访问代码都可以在自动建立过程中自动生成


//使用场景
//1：事物脚本
//可以很好地分离数据库访问代码，并且要很容易被不同的事物脚本重用。不过可能会发现业务逻辑在多处脚本中重复出现。这些逻辑可能会在
//行数据入口中有用。不断的移动这些逻辑会使行数据入口演变为活动记录，这样(减少了业务逻辑的重复)。
//领域模型
//如果要改变数据库的结构但不想改变领域逻辑，采用行数据入口是不错的选择。大多数情况，数据映射器更加适合领域模型
//行数据入口能和数据映射器一起配合使用，尽管这样看起来有点多此一举，不过，当行数据入口从元数据自动生成，而数据映射器由手动实现时，这种方法会很有效。
