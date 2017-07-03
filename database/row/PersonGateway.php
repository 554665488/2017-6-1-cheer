<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/3
 * Time: 13:39
 * @author: yfl
 * @QQ: 554665488  企业应用架构 数据源架构模式之行数据入口
 * @description: 数据源架构模式 - 行入口模式  行数据入口（Row Data Gateway）：充当数据源中单条记录入口的对象，每行一个实例。
 * @time:
 *
 */
require_once './Db.php';

/**
 * @author: yfl
 * @QQ: 554665488
 * @description:  简单实现行数据入口   企业应用架构 数据源架构模式之行数据入口
 * @time:
 * Class PersonGateway
 */
 class PersonGateway
{
    private $_name;
    private $_id;
    private $_birthday;

    public function __construct($_id, $_name, $_birthday)
    {
        $this->_name = $_name;
        $this->_id = $_id;
        $this->_birthday = $_birthday;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->_birthday;
    }


    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->_birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * 入口类自身有更新操作
     */
    public function update()
    {
        $data = array('id' => $this->_id, 'name' => $this->_name, 'birthday' => $this->_birthday);
        $sql = "Update person set";
        foreach ($data as $index => $datum) {
            $sql .= "`" . $index . "`='" . $datum . "',";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " where id=" . $this->_id;
//        echo $sql;
         return DB::query($sql);

    }

    /**
     * 入口类本身有插入的操作
     */
    public function insert()
    {
        $data = array('name' => $this->_name, 'birthday' => $this->_birthday);

        $sql = "insert into person";

        $sql .= "(`" . implode("`,`", array_keys($data)) . "`)";

        $sql .= "VALUES('" . implode("','", array_values($data)) . "')";
        return DB::query($sql);
    }

    /**
     * @author: yfl
     * @QQ: 554665488
     * @description: 此处可加上缓存  这里返回的是一个对象 对应数据库表的一条记录
     * @time:
     * @param $rs
     * @return PersonGateway
     */
    public static function load($rs)
    {
        return new PersonGateway($rs['id'] ? $rs['id'] : NULL, $rs['name'], $rs['birthday']);

    }


}

$perObjByRow = new PersonGateway('1', '张飞', '201-7-9');
$perObjByRow->update();
$perObjByRow->insert();


