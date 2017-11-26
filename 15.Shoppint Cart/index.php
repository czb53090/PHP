<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        table{
            margin: 0 auto;
            width: 750px;
            height: 500px;
            border: 1px solid #aaa;
            text-align: center;
        }
        td{
            width: 250px;
            border: 2px solid skyblue;
        }
        img{
            width: 100px;
            height: 170px;
        }
        .submit{
            width: 80px;
            height: 25px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if (isset($_POST['submit']))
    {
        if (!isset($_SESSION['uname']) || ''==$_SESSION['uname'])
        {
            echo "<script language='javascript'>";
            echo "alert('你尚未登陆，请先登陆！');";
            echo "window.location.href = 'login.php';";
            echo "</script>";
        }
        else
        {
            // 读取购物车中旧数据
            $str_bname = $_COOKIE['bname'];
            $str_bprice = $_COOKIE['bprice'];
            $str_bcount = $_COOKIE['bcount'];
            // 转为数组
            $arr_bname = explode("@", $str_bname);
            $arr_bprice = explode("@", $str_bprice);
            $arr_bcount = explode("@", $str_bcount);
            $bname = $_POST['bname'];
            $bprice = $_POST['bprice'];
            $key = array_search($bname, $arr_bname);
            if ($key)
                $arr_bcount[$key] += 1;
            else // 不存在
            {
                array_push($arr_bname, $bname);
                array_push($arr_bprice, $bprice);
                array_push($arr_bcount, 1);
            }
            // 更新数据
            $str_bname = implode("@", $arr_bname);
            $str_bprice = implode("@", $arr_bprice);
            $str_bcount = implode("@", $arr_bcount);
            // 重写COOKIE
            setcookie("bname", $str_bname, time()+3600);
            setcookie("bprice", $str_bprice, time()+3600);
            setcookie("bcount", $str_bcount, time()+3600);
            echo "<script language='javascript'>";
            echo "alert('加入购物车成功！');";
            echo "window.location.href='index.php';";
            echo "</script>";
        }
    }
?>
<table cellspacing="0">
    <tr><td colspan="3"><h2>迷你电子书城</h2></td></tr>
    <tr><td colspan="3"><h3>
        <?php
            if (!isset($_SESSION['uname']) || ''==$_SESSION['uname'])
                echo "您尚未登陆，请先登陆！";
            else
            {
                echo "欢迎您 ".$_SESSION['uname'];
                $num=explode("@",$_COOKIE['bcount']);//读取书本数量
                $total=0;
                foreach($num as $n)
                {
                    $total+=$n;
                }
                echo "<span id='gwc'><a href='shopping cart.php'>购物车[".$total."]</a></span>";
            }
        ?>
    </h3></td></tr>
    <tr>
        <td><img src="images/1.jpg" alt=""></td>
        <td><img src="images/2.jpg" alt=""></td>
        <td><img src="images/3.jpg" alt=""></td>
    </tr>
    <tr>
        <td>《成长》</td>
        <td>《我们是一群智慧的鱼》</td>
        <td>《水浒全传》</td>
    </tr>
    <tr>
        <td>￥15.00</td>
        <td>￥18.00</td>
        <td>￥25.00</td>
    </tr>
    <tr>
        <td>
            <form action="" method="post" accept-charset="utf-8">
                <input type="hidden" name="bname" value="成长">
                <input type="hidden" name="bprice" value="15">
                <input type="submit" name="submit" value="加入书篮" class="submit">
            </form>
        </td>
        <td>
            <form action="" method="post" accept-charset="utf-8">
                <input type="hidden" name="bname" value="我们是一群智慧的鱼">
                <input type="hidden" name="bprice" value="18">
                <input type="submit" name="submit" value="加入书篮" class="submit">
            </form>
        </td>
        <td>
            <form action="" method="post" accept-charset="utf-8">
                <input type="hidden" name="bname" value="水浒全传">
                <input type="hidden" name="bprice" value="25">
                <input type="submit" name="submit" value="加入书篮" class="submit">
            </form>
        </td>
    </tr>
</table>
</body>
</html>