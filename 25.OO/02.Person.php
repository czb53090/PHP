<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/10/23
 * Time: 15:25
 */

    class Person
    {
        protected $name, $sex;

        public function __construct($name, $sex)
        {
            $this->name = $name;
            $this->sex = $sex;
        }
    }

    class Student extends Person
    {
        private $sid, $sclass;

        public function __construct($name, $sex, $sid, $sclass)
        {
            parent::__construct($name, $sex);
            $this->sid = $sid;
            $this->sclass = $sclass;
        }

        public function print_info()
        {
            echo $this->name."同学，性别：".$this->sex."<br />学号："
                .$this->sid."，班级：".$this->sclass."<br />";
        }
    }

    $student = new Student("陈泽斌", "男", "C16F3734", "16移动应用开发班");
    $student->print_info();
?>