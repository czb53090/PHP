<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        .vote {
            width: 400px;
            margin: 20px auto;
            border-radius: 5px;
            border: 2px solid skyblue;
        }
        .vote .title {
            text-align: center;
            font: 400 18px/40px "Microsoft YaHei";
            background-color: #7af;
        }
        .vote .students {
            padding: 20px 40px;
            font-size: 16px;
            line-height: 24px;
        }
        .vote .submit {
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid  #aaa;
        }
        .vote .submit input {
            width: 60px;
            height: 25px;
            font: 400 12px/100% "SimSun";
        }
        .vote .result {
            width: 200px;
            margin: 20px auto;
            background-color: #ddd;
            padding: 5px 20px;
        }
        .vote .result p.first {
            text-align: center;
            color: #f00;
            font: 700 18px/28px "SimSun";
            border-bottom: 2px solid #aaa;
            margin-bottom: 10px;
        }
        .vote .result p {
            font: 400 16px/26px "Microsoft YaHei";
        }
        .vote .result span.red {
            color: #f00;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="vote">
    <form action="" method="post">
        <p class="title">2016年“十佳学生”网络投票</p>
        <div class="students">
            <?php
            // 打开文件
            $filename = "19.vote.txt";
            $fp = fopen($filename, "a+");
            $filesize = filesize($filename);
            $str_stus = "";

            // 字符串$str_stus以 # 分隔学生，以 @ 分隔每个学生的信息（名字和票数）
            if (0 == $filesize) // 初始化
            {
                $str_stus = "李若耿@0#许鸿周@0#周志伟@0#陈泽斌@0#温卓瀚@0#黄勇博@0#卓明智@0#梁富荣@0#何博@0#叶紫祥@0";
                fwrite($fp, $str_stus);
            }
            else // 获取旧数据
                $str_stus = fread($fp, $filesize);

            $arr_stus_1 = explode("#", $str_stus);
            fclose($fp);

            $arr_stus_2 = array();
            $k = 0;
            // 输出学生的姓名选择框
            foreach ($arr_stus_1 as $str_stu)
            {
                $arr_stu = explode("@", $str_stu);
                $arr_stus_2[$k] = $arr_stu;
                echo "<input type='radio' name='students' id='s$k' value='$arr_stu[0]' /><label for='s$k'> $arr_stu[0]</label> ";
                $k++;
            }
            ?>
        </div>
        <div class="submit">
            <input type="submit" name="submit" >
        </div>
    </form>
    <div class="result">
        <p class="first">投票结果</p>
        <?php
        // 更新和输出数据
        $stus_count = count($arr_stus_2);
        if (isset($_POST['submit']))
        {
            $str_stus_2 = "";
            $fp = fopen($filename, "w");
            for ($i=0; $i<$stus_count; $i++)
            {
                if (isset($_POST['students']) && 0==strcmp($_POST['students'],$arr_stus_2[$i][0]))
                    $arr_stus_2[$i][1] = $arr_stus_2[$i][1]+1;
                $str_stus_2 .= $arr_stus_2[$i][0]."@".$arr_stus_2[$i][1]."#";
            }
            fwrite($fp, substr($str_stus_2, 0, strlen($str_stus_2)-1));
            fclose($fp);
        }

        // 输出投票结果
        for ($i=0; $i<$stus_count; $i++)
        {
            $name = $arr_stus_2[$i][0];
            $poll = $arr_stus_2[$i][1];
            echo "<p>$name : <span class='red'> $poll </span> 票</p>";
        }
        ?>
    </div>
</div>
</body>
</html>