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

////浅析PHP的静态成员函数效率更高的原因   ==============================
class xclass{
     public static $var1 = '1111111111111111';
     public $var2 = 'aaaaaaaaaaaaa';
     public function __construct()
    {
         $this -> var2 = 'bbbbbbbbbbbbbbbb';
         }
     public static function secho1()
    {
         echo self :: $var1 . '<hr />';   //静态方法只可以操作静态变量  因为在静态方法里不会生成$this
   
         // echo $this->var2;
         }
     public function secho2()   //非静态方法可以操作静态变量和非静态变量
    {
    	 echo self::$var1;
         echo $this -> var2 . '<hr />';   //这里的方法体内调用非静态的属性，所以：：作用域限定操作符不可以访问该方法  只可以使用对象的实例访问  $this 作用域为对象
         }
     public function secho3()   //这里的方法声明为动态方法，没有声明为静态方法 系统依然会该方法当成静态成员
    {
         echo 'cccccccccccccc<hr />';
         }
     }
 xclass :: secho1();
 xclass :: secho3();
 echo "------------------------------<br />";
 $xc = new xclass();
 $xc -> secho1();   //实例化的对象访问声明为静态的方法 （应该是静态向动态转换了）（以前理解错误）
 $xc -> secho2();
 //总结  认真看上面的范例，会发现一个有趣的地方，secho1()定义为静态方法后， 在动态类的对像实例中仍可以引用为动态方法，而secho3()也可以被当作静态成员函数，从这个层面，不难理解为什么说静态成员函数比动态的快。
 //     但调用动态类则不同，它要以这个类结构作为样本，在内存中重新生成一个对象实例，所以多了一个过程，这对于简单的类来说，可能不算什么，但对于复杂的类来说这是明显影响效率的。

//可能是由于兼容性原因，php的类成员其实并无明显的动静态之分，所有成员在没明确声明的情况下都会被当成静态成员存放在特定的内存区中，所以调用静态成员函数就和调用普通函数一样，速度很快。


 //有人会担心，使用静态方法会不会造成内存占用过多，其实从上面分析可以知道，你不声明静态方法，系统依然会把成员当成静态，因此对于一个完全静态方法的类和一个完全动态但没声明实例对象的类占用内存几乎是一样的，所以对于比较直接的逻辑，都建议直接用静态成员方法，当然，一些复杂或对像化明显的逻辑，如果完全用静态类也不是没可能，但那样就失去类的意义了，如果这样，何必OOP，按用途，静态方法特别适用于MVC模式的逻辑类中。







 //PHP 5.0对象模型深度探索之类的静态成员

 //1:类的静态成员与一般的类成员不同: 静态成员与对象的实例无关，只与类本身有关。他们用来实现类要封装的功能和数据，但不包括特定对象的功能和数据，静态成员包括静态方法和静态属性。


 //1:与对象的实例无关 
 //2:只有类本身有关
 //3:用来实现（类的）封装的功能和数据 但不包括特定对象的动能和数据
 //4: 静态成员包括静态方法和静态属性。

 //静态属性包含在类中要封装的数据，可以由所有类的实例共享。实际上，除了属于一个固定的类并限制访问方式外，类的静态属性非常类似于函数的全局变量。 

 //1: 静态的属性包括类本身要封装的数据  
 //2: 但是是所有对象实例所共享的。
 //3:除了属于一个固定的类并限制静态属性访问方式  
 //4: 类的静态属性类似于函数的全局变量

 //我们在下例中使用了一个静态属性Counter::$count。它属于Counter类，而不属于任何Counter的实例。你不能用this来引用它，但可以用self或其它有效的命名表达。在例子中，getCount方法返回self::$count，而不是Counter::$count。 


 //静态方法则实现类需要封装的功能，与特定的对象无关. 静态方法非常类似于全局函数. 静态方法可以完全访问类的属性，也可以由对象的实例来访问，不论访问的限定语是否是什么. 
 //1:静态方法实现类要封装的功能（不是对象实例的功能）（该功能与特定的对象无关）
 //2: 静态方法类似于全局方法（函数）
 //3:静态的方法（只）可以访问静态变量
 //4:类的对象的实例也可以访问静态方法 （静态方法向动态方法转换（我猜的））


 // 我们甚至希望在不存在有效的对象时调用它，那么就应该使用静态方法.

 //PHP将不再静态方法内建立$this变量

////6.3例指第四节--构造函数和析构函数中的例子(参看前文)，通过两个例子的比较，你可以很好掌握 static方法与普通方法之间的区别. 
 //一个对象实例访问静态的方法
 //1:static 关键字不能阻止一个对象实例访问静态方法。但是会阻止一个静态实例访问静态属性
 //2: 不会在方法体内创建$this变量
//静态的方式访问 不会执行构造方法__construct和  __destruct析构方法


//1: 可以通过判断$this是否建立来显示静态调用或者非静态调用
//2: 使用了static关键字 这个方法总是静态的.   如果没有使用static  这个方法默认被php认为是静态方法  ，可以转化为动态一静态之间转化


// 在类中声明常量 使用const关键字  

 //1:常量属性总是静态的 他是类的属性 与类的对象实例无关
class Counter  
{
	private static $count = 0;
	const VERSON=1.1;
	public function __construct(){
		self::$count++;
	}
	public function __destruct(){
		self::$count--;
	}
	static function getCount(){
		return self::$count;
	}
};  

//创建一个实例，则__construct()将执行  
$c = new Counter();

// //输出 1  
print(Counter::getCount());  

// //输出类的版本属性  
echo Counter::VERSON;

// 3.静态属性只能被初始化为一个字符值或一个常量，不能使用表达式。即使局部静态变量定义时没有赋初值，系统会自动赋初值0（对数值型变量）或空字符（对字符变量）；静态变量的初始值为0。

// 全局变量本身就是静态存储方式,所有的全局变量都是静态变量