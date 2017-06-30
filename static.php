<?php
header('Content-Type: text/html; charset=utf-8');
// // 静态变量只存在于函数作用域内，也就是说，静态变量只存活在栈中。一般的函数内变量在函数结束后会释放，比如局部变量，但是静态变量却不会。就是说，下次再调用这个函数的时候，该变量的值会保留下来
// function test()

// {

//     static $nm = 1;

//     $nm = $nm * 2;

//     print $nm . "<br />";

// }


// // 第一次执行，$nm = 2

// test();

// // 第一次执行，$nm = 4

// test();

// // 第一次执行，$nm = 8

// test();
// //函数test()执行后，变量$nm的值都保存了下来了。

// //在class中经常使用到静态属性，比如静态成员、静态方法。
// //静态变量$nm属于类nowamagic，而不属于类的某个实例。这个变量对所有实例都有效。
// //::是作用域限定操作符，这里用的是self作用域，而不是$this作用域，$this作用域只表示类的当前实例，self::表示的是类本身。
// class nowamagic
// {

//     public static $nm = 1;


//     function nmMethod()

//     {

//         self::$nm += 2;

//         echo self::$nm . '<br />';

//     }

// }


// $nmInstance1 = new nowamagic();

// $nmInstance1->nmMethod();


// $nmInstance2 = new nowamagic();

// $nmInstance2->nmMethod();

// //Program List：静态属性
// class NowaMagics{

//     public static $nm = 'www.nowamagic.net';

//     public function nmMethod()

//     {

//         return self::$nm;

//     }

// }
     
// class Article extends NowaMagics{

//         public function articleMethod()

//         {
//             return parent::$nm;
//         }

//     }

//     // 通过作用于限定操作符访问静态变量

//     print NowaMagics::$nm . "<br />";

     

//     // 调用类的方法

//     $nowamagic = new NowaMagics();

//     print $nowamagic->nmMethod() . "<br />";

     

//     print Article::$nm . "<br />";

     

//     $nmArticle = new Article();

//     print $nmArticle->nmMethod() . "<br />";

// //简单的静态构造器
//     function Demonstration()

// {

//     return 'This is the result of demonstration()';

// }

// class MyStaticClass

// {

//     //public static $MyStaticVar = Demonstration(); //!!! FAILS: syntax error

//     public static $MyStaticVar = null;

//     public static function MyStaticInit()

//     {

//         //this is the static constructor

//         //because in a function, everything is allowed, including initializing using other functions
//         self::$MyStaticVar = Demonstration();

//     }

// } MyStaticClass::MyStaticInit(); //Call the static constructor

// echo MyStaticClass::$MyStaticVar;

// //This is the result of demonstration()


function test(){    //静态变量仅在局部函数域中存在且只被初始化一次,当程序执行离开此作用域时，其值不会消失,会使用上次执行的结果。
	static $count=0;
	$count++;
	// echo $count;
	if($count<10){
		test();
	}
	// $count--; 
	// echo $count;
};
test();
test();   //1234567891011

class M{
	public $b='b';
	static $c='c';
	public function __construct(){
		echo 'construct';
	}
	public function aa(){

		echo 'aa';
	}
	static function bb(){
		echo 'bb';
	}
}
// $obj=new M();
// $obj->bb();      //静态方法可以通过对象访问=====(这里以前错误)  重点
// echo $obj->b;  //访问对象的成员属性
// echo $obj->$c; //静态变量属于这个类  一对象不可以访问
// echo M::$b; //非静态变量（）属于对象实例
echo M::bb();  //如果是非静态方法,需要改方法中没有使用$this,即没有调用非静态的变量/方法,当然,调用静态的变量/方法没有问题.

// 重点：：：：静态static:声明类成员或方法为 static,就可以不实例化类而直接访问,不能通过一个对象来访问其中的静态成员(静态方法除外),静态成员属于类,不属于任何对象实例,但类的对象实例都能共享.

/*然后我们再看一下使用$object->… 和使用class::… 都有什么区别:
1. 使用$object->… ，需要执行构造函数创建对象.
2. 使用class::… 调用静态方法/变量，不需要执行构造函数创建对象.
3. 使用class::… 调用非静态方法，也不需要执行构造函数创建对象.*/  //::作用域限定操作符 可以访问非静态方法 不可以访问静态变量（静态成员）

Class Person{ 
    // 定义静态成员属性 
    public static $country = "中国"; 
    // 定义静态成员方法 
    public static function myCountry() { 
        // 内部访问静态成员属性 
        echo "我是".self::$country."人<br />"; 
    } 
} 
class Student extends Person { 
    function study() { 
        echo "我是". parent::$country."人<br />"; 
    } 
} 
// 输出成员属性值 
echo Person::$country."<br />";  // 输出：中国 
$p1 = new Person(); 
//echo $p1->country;   // 错误写法 
// 访问静态成员方法 
Person::myCountry();   // 输出：我是中国人 
// 静态方法也可通过对象访问： 
$p1->myCountry(); 
 
// 子类中输出成员属性值 
echo Student::$country."<br />"; // 输出：中国 
$t1 = new Student(); 
$t1->study();    // 输出：我是中国人



   // function foo(){ 
   // static $int = 0;// correct 
   // static $int = 1+2;   // wrong (as it is an expression)   //静态变量赋值不可以使用表达式的结果对其赋值会导致解析错误
   // static $int = sqrt(121); // wrong (as it is an expression too) 
   // $int++; 
   // echo $int; 
   // } 
   function Test2() 
   { 
   static $w3sky = 0; 
   
   $w3sky++; 
   echo $w3sky; 
   }
   Test2();//1
   Test2();//2

////浅析PHP的静态成员函数效率更高的原因
class xclass{
     public static $var1 = '1111111111111111';
     public $var2 = 'aaaaaaaaaaaaa';
     public function __construct()
    {
         $this -> var2 = 'bbbbbbbbbbbbbbbb';
         }
     public static function secho1()
    {
         echo self :: $var1 . '<hr />';
         }
     public function secho2()
    {
         echo $this -> var2 . '<hr />';   //这里的方法体内调用非静态的属性，所以：：作用域限定操作符不可以访问该方法  只可以使用对象的实例访问  $this 作用域为对象
         }
     public function secho3()
    {
         echo 'cccccccccccccc<hr />';
         }
     }
 xclass :: secho1();
 xclass :: secho3();
 echo "------------------------------<br />";
 $xc = new xclass();
 $xc -> secho1();
 $xc -> secho2();
 //总结  认真看上面的范例，会发现一个有趣的地方，secho1()定义为静态方法后， 在动态类的对像实例中仍可以引用为动态方法，而secho3()也可以被当作静态成员函数，从这个层面，不难理解为什么说静态成员函数比动态的快。
 //     但调用动态类则不同，它要以这个类结构作为样本，在内存中重新生成一个对象实例，所以多了一个过程，这对于简单的类来说，可能不算什么，但对于复杂的类来说这是明显影响效率的。