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
            margin: 30px auto;
            text-align: center;
        }
        tr{
            background-color: skyblue;
        }
        td{
            padding: 5px;
            border: 2px solid #cef;
        }
        .submit{
            width: 50px;
            height: 25px;
        }
    </style>
</head>
<body>
<form action="" method="post">
    <table cellspacing="0">
        <tr><td colspan="2"><h3>登陆</h3></td></tr>
        <tr>
            <td><h4><label for="uname"></label>
            用户名：</h4></td>
            <td><input type="text" name="uname" id="uname"></td>
        </tr>
        <tr><td colspan="2"><input type="submit" name="submit" class="submit"></td></tr>
    </table>
</form>
<?php
    session_start();
    if (isset($_POST['submit']))
    {
        $_SESSION['uname'] = $_POST['uname'];
        $bname=$_SESSION['uname'];
        setcookie("bname", $bname, time()+3600);
        setcookie("bprice", 0, time()+3600);
        setcookie("bcount", 0, time()+3600);
        echo "<script language='javascript'>";
        echo "alert('登陆成功！');";
        echo "window.location.href = 'index.php';";
        echo "</script>";
    }
?>
</body>
</html>