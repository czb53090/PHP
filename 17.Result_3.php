<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>考试成绩</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: Microsoft YaHei;
        }
        table{
            margin: 10px auto;
            width: 800px;
            border: 1px solid #ccc;

        }
        h2.result{
            width: 200px;
            position: absolute;
            left: 50%;
            margin-left: -100px;
            top: 20px;
            text-align: center;
            color: #ffc;
            font-size: 20px;
        }
        h2.result span{
            font-size: 20px;
            color: red;
        }
        tr{
            height: 50px;
        }
        tr.first{
            background-color: dodgerblue;
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
        td p{
            line-height: 40px;
        }
        td span.sign{
            color: red;
            font-weight: bold;
        }
        td span.right_answer{
            color: orange;
        }
        .fr{
            float: right;
        }
        .pr5{
            padding-right: 5px;
        }
        .ul{
            text-decoration: underline;
        }
        .tar{
            text-align: right;
        }
    </style>
</head>
<body>
<table cellspacing="0">
    <tr class="first">
        <td colspan="2"></td>
    </tr>
    <?php
        // 单选题输出和计分
        function Radio_Score($radio)
        {
            $score = 0;

            for ($i=0; $i<$radio["num"]; $i++)
            {
                $answer = 0;
                $pos = -1;
                if (isset($_POST["radio$i"]))
                {
                    $answer = $_POST["radio$i"][0]; // 存放答案结果
                    $pos = $_POST["radio$i"][1]; // 选中项的位置
                }

                $num = $i+1; // 第几题
                $title = $radio[$i]['title']; // 题目

                echo "<tr><td>单选题$num</td><td>$title(".$radio["score"]."分)";
                echo "<span class='fr'>得分：<span class='sign pr5'>";
                echo $answer ? $radio["score"] : 0;
                echo "</span></span></td></tr><tr><td>我的答案：";

                if (-1 == $pos)
                    echo "未作答";
                else
                    echo chr(65+$pos);
                echo "</td><td>";

                $flag = 0;
                for ($j=0; $j<4; $j++)
                    if (strlen($radio[$i]["option"][$j]) > 15)
                    {
                        $flag = 1;
                        break;
                    }

                for ($j=0; $j<4; $j++) // 选项
                {
                    if($flag) echo "<p>";

                    if ($radio[$i]["answer"]-1 == $j)
                        echo "<span class='right_answer'>";

                    echo chr(65+$j).". ".$radio[$i]["option"][$j]." ";

                    if ($radio[$i]["answer"]-1 == $j)
                        echo "</span>";

                    // 设置分数
                    if ($j == $pos)
                    {
                        echo "<span class='sign'>";
                        if ($answer)
                        {
                            echo "√";
                            $score += $radio["score"];
                        }
                        else
                            echo "×";
                        echo " </span>";
                    }

                    if($flag) echo " </p>";
                }
                echo "</td></tr>";
            }

            return $score;
        }
        // 多选题输出和计分
        function Multiselect_Score($multiselect)
        {
            $score = 0;

            for ($i=0; $i<$multiselect['num']; $i++)
            {
                $answer = array(0,0,0,0);
                $pos = array(-1,-1,-1,-1);

                $answer_flag = 1; // 用来判断第$i的对错
                $mt_num = 0;
                if (isset($_POST["multiselect$i"]))
                {
                    $mt_num = count($_POST["multiselect$i"]); // 选中答案个数
                    for ($j=0; $j<$mt_num; $j++)
                    {
                        $answer[$j] = $_POST["multiselect$i"][$j][0]; // 存放答案结果

                        if (!$answer[$j]) // 选中的项出现错误
                            $answer_flag = 0;

                        $pos[$j] = $_POST["multiselect$i"][$j][1]; // 存放位置
                    }
                }

                $num = $i+1; // 第几题
                $title = $multiselect[$i]['title']; // 题目

                echo "<tr><td>多选题$num</td><td>$title(".$multiselect["score"]."分)";
                echo "<span class='fr'>得分：<span class='sign pr5'>";
                // 设置分数
                if ($answer_flag && $mt_num) // 选中的选项中无错误并至少选中一项
                {

                    if (count($multiselect[$i]["answer"]) == $mt_num)
                    {
                        echo $multiselect["score"];
                        $score += $multiselect["score"];
                    }
                    else
                    {
                        echo $multiselect["score"]/2;
                        $score += $multiselect["score"]/2;
                    }
                }
                else // 没有或错选
                    echo 0;

                echo "</span></span></td></tr><tr><td>我的答案：";
                if (!$mt_num) // 没有选中任何一项
                    echo "未作答";
                else
                    for ($j=0; $j<$mt_num; $j++)
                        echo chr(65+$pos[$j])." ";

                echo "</td><td>";

                $flag = 0;
                for ($j=0; $j<4; $j++)
                    if (strlen($multiselect[$i]["option"][$j]) > 15)
                    {
                        $flag = 1;
                        break;
                    }

                $n = $k = $m = 0;
                for ($j=0; $j<4; $j++) // 选项
                {
                    if($flag)
                        echo "<p>";

                    if ($multiselect[$i]["answer"][$k]-1 == $j)
                        echo "<span class='right_answer'>";

                    echo chr(65+$j).". ".$multiselect[$i]["option"][$j]." ";

                    if ($multiselect[$i]["answer"][$k]-1 == $j)
                    {
                        echo "</span>";
                        $k++;
                    }

                    if ($j == $pos[$m])
                    {
                        echo "<span class='sign'>";
                        if ($answer[$m])
                            echo "√";
                        else
                            echo "×";
                        echo " </span>";

                        $m++;
                    }


                    if($flag)
                        echo "</p>";
                }

                echo "</td></tr>";
            }

            return $score;
        }
        // 填空题输出和计分
        function Sentence_Score($sentence)
        {
            $score = 0;

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

                //计算句子数目
                $sentence_num = count($sentence[$i]["title"])+count($sentence[$i]["answer"]);

                $n = $k = $flag = $current_score = 0;
                for ($j=0; $j<$sentence_num; $j++)
                {
                    if (isset($_POST["sentence$i$k"]) && $j+1==$sentence[$i]["position"][$k])
                    {
                        $s = $_POST["sentence$i$k"];
                        echo "<span class='ul'>$s<span class='sign'>";
                        if (!strcmp($s,$sentence[$i]["answer"][$k])) // 判断答案
                        {
                            echo " √ ";
                            $flag = 1;
                            $current_score += $sentence["score"]; // 当前句子得分
                            $score += $sentence["score"]; // 填空总分
                        }
                        else
                            echo " × ";
                        echo "</span></span>";
                        $k++;
                    }
                    else
                    { // 输出已给的题目答案
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

                echo "(<span class='right_answer'>";
                for ($j=0; $j<count($sentence[$i]["answer"]); $j++)
                    echo " ".$sentence[$i]["answer"][$j]." ";
                echo "</span>)</p>";

                echo "<p class='tar'>得分：<span class='sign pr5'>";
                echo $flag ? $current_score : 0;
                echo "</span></p>";
            }
            echo "</td></tr>";

            return $score;
        }


        $radio = $multiselect = $sentence = ""; // 用来存放答案和题目
        if (isset($_SESSION['radio'])) // && isset($_SESSION['multiselect']) && isset($_SESSION['sentence'])
        {
            $radio = $_SESSION['radio'];
            $multiselect = $_SESSION['multiselect'];
            $sentence = $_SESSION['sentence'];
        }
        else
        {
            session_destroy();
            echo "<script language='javascript'>";
            echo "alert('页面已过期，请重新答题！');";
            echo "window.location.href = '17.Examination_3.php';";
            echo "</script>";
        }

        $radio_score = Radio_Score($radio); // 单选分数
        $multiselect_score = Multiselect_Score($multiselect); //多选分数
        $sentence_score = Sentence_Score($sentence); //填空分数

        $sum = $radio_score + $multiselect_score + $sentence_score; // 总分
    ?>
</table>
<h2 class="result">考试成绩：<span><?php echo $sum; ?></span></h2>
</body>
</html>