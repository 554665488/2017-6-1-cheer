<?php
/**本源码由www.it123.org提供**/
require 'QueryList.class.php';
$pattern = array(
    "title" => array(".joke-title a", "text"),
    "href" => array(".joke-title a", "href"),
);
$url = "http://www.mahua.com/diggjokes/text/";
$qy = new QueryList($url, $pattern, '', '', 'utf-8');
$rs = $qy->jsonArr;
$ul = "<ul>";
foreach($rs as $v){
	$ul .= "<li class='tit'><a href='".$v['href']."'>".$v['title']."</a></li>";
}
$ul .= "</ul>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>www.it123.org---php采集开心麻花demo演示</title>
<style type="text/css">
html,body {
	font-size: 12px;
	font-family: Arial, Lucida, Verdana, "寰蒋闆呴粦", "瀹嬩綋", Helvetica,
		sans-serif;
	line-height: 24px;
	margin: 0;
	padding: 0;
	color: #222;
	background: #fff;
}

.ckeditor {
	line-height: 1.2em;
}

ul,li,ol.dl,dt,dd,h1,h2,h3,p {
	padding: 0;
	margin: 0;
	list-style: none;
}

a {
	color: #7C5EA8;
	text-decoration: none;
}

a:hover {
	color: #7C5EA8;
}

.container {
	width: 800px;
	margin: 30px auto;
	border: 1px solid #ccc;
	border-radius: 8px;
}

.demo {
	padding: 15px;
}

.tit {
	margin-top: 10px;
}

h2 {
	border-bottom: 1px solid #ccc;
}

.notice {
	color: #999;
	line-height: 30px;
}

.des {
	line-height: 20px;
	color: #999;
}

.red {
	color: red;
	font-size: 16px
}
</style>
</head>
<body>
<div class="container">
<div class="demo">
<h2 class="title"><a href="http://www.it123.org">经验：phpQuery强大的采集器--本源码由www.it123.org论坛技术小组强力驱动</a></h2>
<p class="notice">提示：从快乐麻花http://www.mahua.com/diggjokes/text/首页采集下来的笑话列表</p>
<p class="notice red">提示：如果大家觉得有兴趣，可以关注it123社区，后续会更新更精彩的内容</p>
<?php echo $ul;?></div>
</div>

</body>
</html>



