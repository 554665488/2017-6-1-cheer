<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/4
 * Time: 16:33
 * @author: yfl
 * @QQ: 554665488
 * @description:
 * bool array_walk_recursive ( array &$input , callable $funcname [, mixed $userdata = NULL ] )
   将用户自定义函数 funcname 应用到 array 数组中的每个单元。本函数会递归到更深层的数组中去。在funcname 函数中，数组的键名和键值是该函数的参数。
 * @time:
 */
$sweet = array('a' => 'apple', 'b' => 'banana');
$fruits = array(
    'sweet' => $sweet,
    'sour' => 'lemon'
);
var_dump($fruits);
function test_print($item, $key)
{   $item='引用改变';
    echo " $key holds $item <br/>";
}
array_walk_recursive($fruits, 'test_print');
var_dump($fruits);
//不加&
/**
 * 结果
 * a holds apple
   b holds banana
   sour holds lemon
 */
//Note:如果 funcname 需要直接作用于数组中的值，则给 funcname 的第一个参数指定为引用。这样任何对这些单元的改变也将会改变原始数组本身。
/**
 * 结果
 * a holds 引用改变
   b holds 引用改变
   sour holds 引用改变
 */