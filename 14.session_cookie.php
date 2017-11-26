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
            width: 300px;
            padding: 20px;
            background-color: skyblue;
            position: absolute;
            top: 100px;
            left: 50%;
            margin-left: -160px;
        }
        tr{
            height: 30px;
        }
        tr.first{
            text-align: center;
            height: 50px;
        }
        .submit{
            width: 50px;
            height: 25px;
            font-size: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    session_save_path('D:\PHP\School Assignment\SESSION');
    session_start();

    //print_r($_SESSION);
    //print_r($_COOKIE);
    if (isset($_GET['oid']) && 0==$_GET['oid'])
    {
        session_destroy(); // 销毁会话对象
        setcookie('UNAME', "", time()-3600); // 让cookie在一小时前失效
        header("location:14.session_cookie.php"); //跳转刷新
    }
    if (isset($_SESSION['UNAME']) && isset($_COOKIE['UNAME']) && $_SESSION['UNAME']==$_COOKIE['UNAME'])
    {
        echo "欢迎您：".$_SESSION['UNAME']."</br>";
        echo "<a href = '14.session_cookie.php?oid=0'>退出登录</a>";
    }
    else
    {
        echo <<< AA
    <form action="" method="post">
        <table>
            <tr class="first">
                <td colspan="2">
                    <h3>你尚未登陆，请先登录</h3>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <label for="username">用户名：</label>
                </td>
                <td>
                    <input type="text" name="username" id="username">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="userpw">密码：</label>
                </td>
                <td>
                    <input type="text" name="userpw" id="userpw">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" class="submit">
                </td>
            </tr>
        </table>
    </form>
AA;
    }
    if (isset($_POST['submit']))
    {
        //$time = 60; //60s的session有效期
        //setcookie(session_name(), session_id(), time()+$time);

        setcookie('UNAME', $_POST['username'], time()+24*60*60*7); // 保存七天

        $_SESSION['UNAME'] = $_POST['username']; //存储用户名


        header("location:14.session_cookie.php"); //跳转刷新
    }
    ?>
</body>
</html>