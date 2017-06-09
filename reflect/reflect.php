<?php

class Product
{
    public $name;
    public $price;
    private $test;
    public static $a;
    private static $b;
    protected static $c;
    
    function __construct ( $name, $price )
    {
        $this->name = $name;
        $this->price = $price;
    }
    
    private function test(){}
}

//Reflection //为类的摘要信息提供静态函数[b]exprot()[/b]

$prod_class = new ReflectionClass('Product');//类信息和工具
echo "<pre>";
var_dump($prod_class);
// Reflection::export( $prod_class );
echo "</pre>";