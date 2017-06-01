<?php
set_time_limit(0);
function code_linenum($path, $i) {
if (!is_dir($path)) {
return false;
}
$files = glob($path . '/*');
if ($files) {
foreach ($files as $file) {
if (is_dir($file)) {
code_linenum($file, $i);
}
$buffer = '';
$handle = @fopen($file, 'r');
if ($handle) {
while(!feof($handle)) {
$buffer = fgets($handle,4096);
$buffer = trim($buffer);	//同等于==$buffer = str_replace("\r\n", '', $buffer);
if (!empty($buffer)) {
$comments = array();
$comments[0]  = '';
$comments[0] .= preg_match('/\/\//i', $buffer) ? '####' : '';
$comments[0] .= preg_match('/\/\*\*/i', $buffer) ? '####' : '';
$comments[0] .= preg_match('/\*\s/i', $buffer) ? '####' : '';
$comments[0] .= preg_match('/\*\//i', $buffer) ? '####' : '';
if (empty($comments[0])) {
global $i;
$i++;
}
}
}
fclose($handle);
}
}
}
return $i;
}
//调用函数
global $i;
$linenums =  code_linenum('D:/phpstudy/www/minjiedai' ,$i);
echo '代码总行数为：' . $linenums;