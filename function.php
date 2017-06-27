<?php
/*stream_context_create作用：
创建并返回一个文本数据流并应用各种选项，可用于fopen(),file_get_contents()等过程的超时设置、代理服务器、请求方式、头信息设置的特殊过程。
函数原型：resource stream_context_create ([ array $options [, array $params ]] )

在使用file_get_contents函数的时候，经常会出现超时的情况，在这里要通过查看一下错误提示，看看是哪种错误，比较常见的是读取超时，这种情况大家可以通过一些方法来尽量的避免或者解决。这里就简单介绍两种：

一、增加超时的时间限制

这里需要注意：set_time_limit只是设置你的PHP程序的超时时间，而不是file_get_contents函数读取URL的超时时间。
一开始以为set_time_limit也能影响到file_get_contents，后来经测试，是无效的。真正的修改 file_get_contents延时可以用resource $context的timeout参数：*/

$opts = array(
    'http'=>array(
    'method'=>"GET",
    'timeout'=>60,
  )
);
//创建数据流上下文
$context = stream_context_create($opts);

$html =file_get_contents('http://blog.sina.com/mirze', false, $context);

//fopen输出文件指针处的所有剩余数据:
//fpassthru($fp); //fclose()前使用
/*
二、一次有延时的话那就多试几次

有时候失败是因为网络等因素造成，没有解决办法，但是可以修改程序，失败时重试几次，仍然失败就放弃，因为file_get_contents()如果失败将返回 FALSE，所以可以下面这样编写代码：
$cnt=0;
while($cnt < 3 && ($str=@file_get_contents('http://blog.sina.com/mirze'))===FALSE) $cnt++;

以上方法对付超时已经OK了。

那么Post呢？细心点有人发现了'method'=>"GET", 对！是不是能设置成post呢？百度找了下相关资料，还真可以！而且有人写出了山寨版的post传值函数，如下：

*/
function Post($url, $post = null){
     $context = array();

     if (is_array($post)) {
         ksort($post);

         $context['http'] = array (
             'timeout'=>60,
             'method' => 'POST',
             'content' => http_build_query($post, '', '&'),
         );
     }
     return file_get_contents($url, false, stream_context_create($context));
}

$data = array(
     'name' => 'test',
     'email' => 'test@gmail.com',
     'submit' => 'submit',
);
echo Post('http://www.ej38.com', $data);
