<?php
    ob_start(); // 出现警告：Cannot modify header information问题的解决方法
    session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>在线考试程序</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: "Microsoft YaHei";
        }
        table{
            margin: 10px auto;
            width: 800px;
            border: 1px solid #ccc;
        }
        tr{
            height: 50px;
        }
        tr.first{
            background-color: dodgerblue;
        }
        tr.first td h2{
            color: #ffc;
        }
        tr.first h2{
            font-size: 20px;
            line-height: 30px;
        }
        tr:nth-child(2n){
            background-color: #afa;
        }
        td:nth-child(1){
            width: 180px;
            text-align: center;
        }
        tr.last{
            background-color: skyblue;
        }
        td p{
            line-height: 40px;
        }
        .submit1{
            width: 80px;
            height: 25px;
            font-size: 12px;
        }
        .submit2{
            width: 50px;
            height: 25px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<form method="post" name="form" >
    <table cellspacing="0">
        <tr class="first">
            <td colspan="2" ><h2>在线考试程序</h2></td>
        </tr>
        <?php

            // 进行初始化的目的：可在初始化函数中添加题目并设置一些信息
            // 初始化单选题
            function Init_Radio(){
                $radio = array(); // 存放单选题题目的数组
                $radio["num"] = 2; //单选题数目
                $radio["score"] = 5;

                // 第一题
                $radio[0]["title"] = "下列属于宋代诗人的是：";
                $radio[0]["answer"] = 3;
                $radio[0]["option"] = array("岑参", "高适", "杨万里", "宋之问");
                // 第二题
                $radio[1]["title"] = "下列不属于苏东坡的作品是：";
                $radio[1]["answer"] = 4;
                $radio[1]["option"] = array("念奴娇·赤壁怀古", "水调歌头·千里共婵娟", "江城子·十年生死两茫茫", "踏莎行·郴州旅社");
                //第···题

                return $radio;
            }
            // 初始化多选题
            function Init_Multiselect(){
                $multiselect = array(); // 存放多选题题目的数组
                $multiselect["num"] = 2; // 多选题数目
                $multiselect["score"] = 10; // 默认：全对满分，少选一半分，错选没选0分

                $multiselect[0]["title"] = "下列属于唐宋八大家的作者是：";
                $multiselect[0]["answer"] = array(2, 4);
                $multiselect[0]["option"] = array("杜甫", "曾孔", "王勃", "苏洵");

                $multiselect[1]["title"] = "请选出属于七绝的作品";
                $multiselect[1]["answer"] = array(1, 3, 4);
                $multiselect[1]["option"] = array("滁州西涧", "登鹳雀楼", "钱塘湖春行", "登科后");

                return $multiselect;
            }
            // 初始化填空题
            function Init_Sentence(){
                $sentence = array(); // 存放多选题题目的数组
                $sentence["num"] = 4; // 多选题数目
                $sentence["score"] = 5; // 一个句子5分

                $sentence[0]["title"] = array("逐舞飘清袖", "传歌共绕梁", "吹花松远乡");
                $sentence[0]["answer"] = array("动枝生乱影");
                $sentence[0]["position"] = array(3); // 断句位置

                $sentence[1]["title"] = array("间关莺语花底滑", "幽咽泉流冰下难");
                $sentence[1]["answer"] = array("嘈嘈切切错杂弹", "大珠小珠落玉盘");
                $sentence[1]["position"] = array(1, 2);

                $sentence[2]["title"] = array("而神明自得", "圣心备焉");
                $sentence[2]["answer"] = array("积善成德");
                $sentence[2]["position"] = array(1);

                $sentence[3]["title"] = array("金樽清酒斗十千");
                $sentence[3]["answer"] = array("玉盘珍羞直万钱");
                $sentence[3]["position"] = array(2);

                return $sentence;
            }

            $radio = Init_Radio();
            $multiselect = Init_Multiselect();
            $sentence = Init_Sentence();

            // 存放题目至 SESSION 数组以便在 result.php 中使用
            // session_destroy(); // 在SESSION生命期内更改题目代码需先销毁SESSION,重新存储题目
            // 设置session
            if (!isset($_SESSION['radio'])) // 加判断避免每次页面刷新都重复写入SESSION
                $_SESSION['radio'] = $radio;
            if (!isset($_SESSION['multiselect']))
                $_SESSION['multiselect'] = $multiselect;
            if (!isset($_SESSION['sentence']))
                $_SESSION['sentence'] = $sentence;
            //设置session的生命期,也是 result.php 页面的保存时间
            $time = 3600*24; // 一天
            if (isset($_POST['submit']))
                setcookie(session_name(), session_id(), time()+10);

            // 输出单选题
            for ($i=0; $i<$radio["num"]; $i++)
            {
                $num = $i+1; // 第几题
                $title = $radio[$i]['title']; // 获取题目

                echo "<tr><td>单选题$num</td><td>$title(".$radio["score"]."分)</td></tr>";
                echo "<tr><td></td><td>";

                $flag = 0;
                for ($j=0; $j<4; $j++)
                    if (strlen($radio[$i]["option"][$j]) > 15) //判断各个选项的文本长度是否能容纳在一行内
                    {
                        $flag = 1;
                        break;
                    }

                for ($j=0; $j<4; $j++) // 选项
                {
                    //答案较长的选项则以 行(p标签) 为分界，否则都输出在同一行
                    if($flag) echo "<p>";

                    $option = $radio[$i]["option"][$j]; //获取第$j个选项文本
                    echo "<input type='radio' name='radio$i' id='radio$i$j' value='";
                    echo $j+1==$radio[$i]["answer"] ? "1": "0"; //1代表正确答案,写入value作为表单数据
                    echo "$j' "; // $j(0起始) 代表第几个选项，与上面是否为正确答案配合使用
                    // 单选框状态
                    if (isset($_COOKIE["radio_chk$i"]) && $_COOKIE["radio_chk$i"]==$j)
                        echo "checked='checked'";
                    echo " ><label for='radio$i$j'> $option </label> ";

                    if($flag) echo "</p>";
                }

                echo "</td></tr>";
            }

            // 输出多选题
            for ($i=0; $i<$multiselect['num']; $i++)
            {
                $num = $i+1; // 第几题
                $title = $multiselect[$i]['title']; // 题目

                echo "<tr><td>多选题$num</td><td>$title(".$multiselect["score"]."分)</td></tr>";
                echo "<tr><td></td><td>";

                $flag = 0;
                for ($j=0; $j<4; $j++)
                    if (strlen($multiselect[$i]["option"][$j]) > 15)
                    {
                        $flag = 1;
                        break;
                    }

                $n = 0; // 判断多选框状态处使用
                for ($j=0; $j<4; $j++) // 选项
                {
                    if($flag)
                        echo "<p>";


                    $option = $multiselect[$i]["option"][$j];
                    echo "<input type='checkbox' name='multiselect$i"."[]' id='multiselect$i$j' value='";
                    // 判断第$i题第$j个选项是否为正确答案，并设置value的值，正确为1，错误为0
                    $flag2 = 0;
                    for ($k=0; $k<count($multiselect[$i]["answer"]); $k++)
                        if ($j+1 == $multiselect[$i]["answer"][$k])
                        {
                            $flag2 = 1;
                            break;
                        }
                        else
                            continue;
                    echo $flag2 ? "1" : "0";
                    echo "$j' ";
                    // 多选框状态
                    if (isset($_COOKIE["multiselect_chk$i$n"]) && $_COOKIE["multiselect_chk$i$n"]==$j)
                    {
                        echo "checked='checked'";
                        $n++;
                    }
                    echo" ><label for='multiselect$i$j'> $option </label> ";

                    if($flag)
                        echo "</p>";
                }

                echo "</td></tr>";
            }

            // 填空题
            // 计算填空题个数以输出总分
            $score_num = 0;
            for ($i=0; $i<$sentence['num']; $i++)
                $score_num += count($sentence[$i]["answer"]);
            $sum = $sentence['score']*$score_num;
            echo "<tr><td>填空题</td><td>请补充完整下面的诗词：($sum"."分)</td></tr>";

            // 输出填空题
            echo "<tr><td></td><td>";
            for ($i=0; $i<$sentence["num"]; $i++)
            {
                echo "<p>";

                // 计算一段句子的子句个数
                $sentence_num = count($sentence[$i]["title"])+count($sentence[$i]["answer"]);

                $n = $k = 0;
                for ($j=0; $j<$sentence_num; $j++)
                {
                    if (isset($sentence[$i]["position"][$k]) && $j+1==$sentence[$i]["position"][$k])
                    { // 在指定位置输出文本框
                        echo "<input type='text' name='sentence$i$k' maxlength='10' size='20' value='";

                        if (isset($_COOKIE["sentence_chk$i$k"]))
                            echo $_COOKIE["sentence_chk$i$k"];

                        echo "' />";
                        $k++;
                    }
                    else
                    { // 输出已给题目子句
                        $title = $sentence[$i]['title'][$n];
                        echo "$title";
                        $n++;
                    }

                    // 标点设置
                    if ($j+1 == $sentence_num)
                        echo "。";
                    else
                    {
                        if (3 == $sentence_num)
                            echo "，";
                        else if (!($sentence_num%2))
                        {
                            if ($j%2)
                                echo "。";
                            else
                                echo "，";
                        }
                    }
                }
                echo "</p>";
            }
            echo "</td></tr>";

            if (isset($_POST['savebt']))
            {
            $val = 5400; // 设置cookie有效时间

            //删除cookie
            for ($i=0; $i<4; $i++) // 选择题
            {
                if (isset($_COOKIE["radio$i"]))
                    setcookie("radio_chk$i", "", time()-$val);
            }
            for ($i=0; $i<$multiselect["num"]; $i++) // 多选题
            {
                for ($j=0; $j<4; $j++)
                {
                    if (isset($_COOKIE["multiselect_chk$i$j"]))
                        setcookie("multiselect_chk$i$j", "", time()-$val);
                }
            }
            for ($i=0; $i<$sentence["num"]; $i++) // 填空题
            {
                $num = count($sentence[$i]["answer"]);
                for ($j=0; $j<$num; $j++)
                {
                    if (isset($_COOKIE["sentence_chk$i$j"]))
                        setcookie("sentence_chk$i$j", $s, time()-$val);
                }
            }


            //设置cookie
            for ($i=0; $i<$radio["num"]; $i++) // 选择题
            {
                if (isset($_POST["radio$i"]))
                {
                    $e = $_POST["radio$i"][1]; // 获取选择的是第几项(0起始)
                    setcookie("radio_chk$i", $e, time()+$val);
                }
            }
            for ($i=0; $i<$multiselect["num"]; $i++) // 多选题
            {
                if (isset($_POST["multiselect$i"]))
                {
                    $t = $_POST["multiselect$i"];
                    for ($j=0; $j<count($t); $j++)
                    {
                        setcookie("multiselect_chk$i$j", $t[$j][1], time()+$val);
                    }
                }
            }
            for ($i=0; $i<$sentence["num"]; $i++) // 填空题
            {
                $num = count($sentence[$i]["answer"]);
                for ($j=0; $j<$num; $j++)
                {
                    if(isset($_POST["sentence$i$j"]))
                    {
                        $s = $_POST["sentence$i$j"];
                        setcookie("sentence_chk$i$j", $s, time()+$val);
                    }
                }
            }

                header("location: 17.Examination_3.php");
            }
        ?>
        <tr class="last">
            <td colspan="2" >
                <input type="submit" name="savebt" value="保存答案" class="submit1" onclick="Savebt()">
                <input type="submit" name="submit" value="交卷" class="submit2" onclick="Submiting()"><!-- onclick="return Check_All()"  -->
            </td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    function Savebt(){
        document.form.action = "17.Examination_3.php";
    }
    function Submiting(){
        document.form.action = "17.Result_3.php";
    }

    // 检查单选和多选是否为空, 可选功能（未完成）
    /*function Check_All()
    {
        radio_num = <?php //echo $radio_num ?>;

    }

    function Check_text_select(text_id, textContent)
    {
        var major = document.getElementById(text_id);

        if (major.value.replace(" ", "").trim() == textContent)
        {
            major.value = textContent;
            return false;
        }
        else
        {
            return true;
        }
    }

    function Check_radio_checkbox(r_c_id)
    {
        var sex = document.getElementsByName(r_c_id);
        var flag = 0;

        for(var i=0; i<sex.length; i++)
            if (sex.item(i).checked == true)
                flag = 1;

        if (!flag)
            return false;
        else
            return true;
    }*/
</script>
</body>
</html>