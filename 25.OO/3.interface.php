<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="q">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Document</title>
    <style>
        p {  font-size: 16px;  line-height: 10px;  }
    </style>
</head>
<body>
<form action="" method="post">
    <input type="submit" name="teacherSub" value="普通教师"/>
    <input type="submit" name="programmerSub" value="程序员"/>
    <input type="submit" name="ITTeacherSub" value="计算机教师"/>
</form>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/10/23
 * Time: 15:38
 */

    interface iTeacher
    {
        function teaching_design();
    }

    interface iProgrammer
    {
        function programme();
    }

    class Teacher implements iTeacher
    {
        function teaching_design()
        {
            echo "<p>教学设计能力是每个教师的必备技能之一</p>";
        }
    }

    class Programmer implements iProgrammer
    {
        function programme()
        {
            echo "<p>程序设计能力直接反映一名程序员的水平</p>";
        }
    }

    class ITTeacher implements iTeacher, iProgrammer
    {
        function teaching_design()
        {
            echo "<p>教学设计能力比较强</p>";
        }

        function programme()
        {
            echo "<p>程序设计能力相对不如专业程序员</p>";
        }

        function speech()
        {
            echo "<p>计算机教师的能力结构如下：</p>";
            $this->teaching_design();
            echo "<p>演讲表现能力是基本功之一</p>";
            $this->programme();
        }
    }

    if (isset($_POST['teacherSub']))
    {
        $teacher = new Teacher;
        $teacher->teaching_design();
    }
    else if(isset($_POST['programmerSub']))
    {
        $programmer = new Programmer;
        $programmer->programme();
    }
    else if(isset($_POST['ITTeacherSub']))
    {
        $itTeacher = new ITTeacher;
        $itTeacher->speech();
    }
?>
</body>
</html>
