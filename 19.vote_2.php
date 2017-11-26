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
            // 输出学生名的选择框
            $stu_name = array("张田芳", "张林秀", "袁定明"); // 保存学生姓名
            $stu_count = count($stu_name);
            for ($i=0; $i<$stu_count; $i++)
                echo "<input type='radio' name='students' id='s$i' value='$i'><label for='s$i'> $stu_name[$i]</label> ";

            // 读取信息或初始化
            $filename = "19.vote_2.txt";
            $str_stus = "";
            if ($fp = @fopen($filename, "r")) // 打开成功直接读取投票信息
            {
                $filesize = filesize($filename);
                $str_stus = fread($fp, $filesize);
            }
            else // 打开文件失败则初始化并写入
            {
                $fp=fopen($filename, "w");
                $str_stus = "0@0#1@0#2@0";
                fwrite($fp, $str_stus);
            }
            $arr_stus_1 = explode("#", $str_stus);

            $arr_stus_2 = array();
            $k = 0;
            foreach ($arr_stus_1 as $str_stu)
            {
                $arr_stu = explode("@", $str_stu);
                $arr_stus_2[$k] = $arr_stu;
                $k++;
            }
            fclose($fp);
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
        if (isset($_POST['submit']) && isset($_POST['students']))
        {
            $choice = $_POST['students'];
            $fp = fopen($filename, "w");
            $str_stus_2 = "";
            for ($i=0; $i<$stu_count; $i++)
            {
                if ($arr_stus_2[$i][0] == $choice)
                    $arr_stus_2[$i][1]++;
                $str_stus_2 .= $arr_stus_2[$i][0]."@".$arr_stus_2[$i][1]."#";
            }
            fwrite($fp, substr($str_stus_2, 0, strlen($str_stus_2)-1));
            fclose($fp);
        }

        // 输出投票结果
        for ($i=0; $i<$stu_count; $i++)
        {
            $name = $stu_name[$i];
            $poll = $arr_stus_2[$i][1];
            echo "<p>$name : <span class='red'> $poll </span> 票</p>";
        }
        ?>
    </div>
</div>
</body>
</html>