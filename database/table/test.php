<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 12:38
 * @author: yfl
 * @QQ: 554665488
 * @description:  测试数据源模式  表入口模式
 * @time: 2017年7月3日 12:43:21
 */
require_once  './person.php';
$p=new person();
$perObj=$p->getPersonById(67)->fetch_assoc();
var_dump($perObj);