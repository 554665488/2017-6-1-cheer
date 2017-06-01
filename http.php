<?php
// echo strstr("I love Shanghai!","Shanghai");//检查字符串在另一个字符串是否存在  存在返回被检查的字符串
$number='1000.000000';
// echo strstr($number,'.');  // .000000
echo strstr("Hello world!","world",true); // hello
// echo $tmp = substr($number, 0, 7);
// echo stripos('abcd','d');//返回字符串在另一个字符串第一次出现的位置  返回索引值 3
function round_down($number, $num = 2)
{
    if (strstr($number, '.')) {
        $p = stripos($number, '.');  //4
        // echo $p.'---';
        $tmp = substr($number, 0, $p + 3);  //1000.00
        //echo $tmp.'----';
    } else {
        $tmp = $number;
    }
    return number_format($tmp, $num);//number_format  通过千位数格式化字符串
}
echo round_down($number);