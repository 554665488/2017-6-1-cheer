<?php
header("Content-type:text/html; charset=utf-8");

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 10:56
 * @author: yfl
 * @QQ: 554665488
 * @description:  客户端调度
 * @time:
 */
require_once './Customer.php';
class Client
{

    public static function main()
    {
        /* 加载客户ID为1的客户信息 */
        $customerObj=Customer::find(1); //获取用户ID为1 的对象实例
        /* 假设用户拥有的定单id为 9527*/
        $customerObj->deleteOrder(100);
    }
}
Client::main();