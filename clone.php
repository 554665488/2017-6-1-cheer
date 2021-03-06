<?php
//for($i=1000;$i--;){
//    echo $i;
//    echo '<br/>';
//}die;
//for ($i=1000;$i>=0;$i--){
//    echo $i;
//    echo '<br/>';
//}
//die;
    class Account {
        public $balance;
        
        public function __construct($balance) {
            $this->balance = $balance;
        }
    }
 
    class Person {
        private $id;
        private $name;
        private $age;
        public $account;
        
        public function __construct($name, $age, Account $account) {
            $this->name = $name;
            $this->age = $age;
            $this->account = $account;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function __clone() {    #复制方法,可在里面定义再clone是进行的操作
            // $this 指的复本$person2， 而$that 是指向原本$person，这样就在本方法里，改变了复本的属性。
            $this->id = 0;

            $this->account = clone $this->account;    #不加这一句,account在clone是会只被复制引用,其中一个account的balance被修改另一个也同样会被修改
            $this->account->balance=50000;
        }
    }
    
    $person = new Person("peter", 15, new Account(1000));
    $person->setId(1);
    $person2 = clone $person;
    
//    $person2->account->balance = 250;
    
    var_dump($person);
	echo "</br>";
	var_dump($person2);
    
 ?>