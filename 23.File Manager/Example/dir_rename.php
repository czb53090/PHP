<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>无标题文档</title>
</head>

<body>
<?Php
if(!empty($_POST['new_dirname']))
{$c_f=$_GET['c_f']; //当前目录路径
    $c_dirname=$_GET['c_dirname'];//需操作文件夹名称
    $old_name=$c_f."\\".$c_dirname;
    $new_name=$c_f."\\".$_POST['new_dirname'];
    rename($old_name,$new_name);
    header("location:dir_tree.php?c_f=$c_f");
}
else
{$c_f=$_GET['c_f']; //当前目录路径
    $c_dirname=$_GET['c_dirname'];//需操作文件夹名称
}
?>
<form id="form1" name="form1" method="post" action="dir_rename.php?c_f=<?php echo $c_f;?>&c_dirname=<?php echo $c_dirname;?>">
    请输入<?php echo $c_dirname;?>的新名称:<br>
    <table width="300" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td bgcolor="#F0F0F0"><label for="new_dirname"></label>
                <input type="text" name="new_dirname" id="new_dirname" />
                <input type="submit" name="button" id="button" value="确定" /></td>
        </tr>
    </table>
</form>
</body>
</html>
