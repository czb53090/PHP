<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
</head>
<body>
<?php
    $flag = 1;
    if (isset($_POST['submit']))
    {
        if (isset($_COOKIE['code']))
        {
            $code = $_POST['code'];
            if (!strcmp($code, $_COOKIE['code']))
            {
                echo "验证成功！";
                $flag = 0;
            }
            else
            {
                echo "验证失败！";
                $flag = 1;
            }
        }
    }
    if ($flag)
    {
?>
<form action="" method="post">
    用户名：
    <input type="text" name="code">
    <?php
        $str = "";
        for ($i=0; $i<4; $i++)
        {
            if (1 == rand(1, 2))
                $asc_num = rand(49, 57);
            else
                $asc_num = rand(65, 90);
            $c = chr($asc_num);
            $str .= $c;
        }
        setcookie('code', $str, time()+30);
        $_COOKIE['code'] = $str;
        echo $str."</br></br>";
    ?>
    <input type="submit" name="submit">
</form>
<?php
    }
?>
</body>
</html>