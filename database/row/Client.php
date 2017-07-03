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