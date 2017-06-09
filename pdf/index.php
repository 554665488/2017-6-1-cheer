<?php

//        $pdf=APP_ROOT.'/upload/contract/1496816222881.pdf';
        $pdf='./abc.pdf';
        $path1='aa';
        $page=-1;


$imagick = new Imagick(); 
$imagick->readImage('fff.pdf[0]'); 
$imagick = $imagick->flattenImages(); 
$imagick->writeFile('fff.jpg'); 
exit;

function pdf2png($PDF,$Path){
   if(!extension_loaded('imagick')){
       return false;
   }
   if(!file_exists($PDF)){
       return false;
   }
   $IM = new imagick();
   $IM->setResolution(120,120);
   $IM->setCompressionQuality(100);

   $IM->readImage($PDF);
   foreach ($IM as $Key => $Var){
       $Var->setImageFormat('png');
       $Filename = $Path.'/'.md5($Key.time()).'.png';
       if($Var->writeImage($Filename) == true){
           $Return[] = $Filename;
       }
   }
   return $Return;
}
pdf2png('./fff.pdf','aa');
exit;
function pdf2png2($pdf,$path,$page=-1)
{  
   
   if(!extension_loaded('Imagick'))
   {  
       return false;  
   } 

   if(!file_exists($pdf))
   {  
       return false;  
   }  
   $im = new Imagick(); 
   $im->setResolution(120,120);  
   $im->setCompressionQuality(100);
   if($page==-1){
     $im->readImage($pdf);
     var_dump($im);
   }else{
      $im->readImage($pdf."[".$page."]");
   }
   foreach ($im as $Key => $Var)
   {  
       $Var->setImageFormat('png');  
       $filename = $path."/". md5($Key.time()).'.png';
       if($Var->writeImage($filename) == true)
       {  
           $Return[] = $filename;  
       }  
   }  
   return $Return;  
}  
$path="aa";//请确保当前目录下有这个文件夹，由于一直要用，所以就不加检测了
$s=pdf2png2("abc.pdf",$path);
$scount=count($s);
for($i=0;$i<$scount;$i++)
{
   echo "<div align=center><font color=red>Page ".($i+1)."</font><br><a href=\"".$s[$i]."\" target=_blank><img border=3 height=1200 width=900 src=\"".$s[$i]."\"></a></div><p>";
}