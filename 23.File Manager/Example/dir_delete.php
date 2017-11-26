<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>无标题文档</title>
</head>

<body>
<?php
$c_f=$_GET['c_f'];  //当前目录路径
$c_dirname=$_GET['c_dirname'];//需操作文件夹名称
$c_dir=$c_f."\\".$c_dirname;
if(!empty($_POST['button']))
{if(@rmdir($c_dir)==true)
{echo "<script language='javascript'>alert('文件夹删除成功');</script>";}
else
{echo "<script language='javascript'>alert('系统删除文件夹失败，请检查文件夹或重新操作');</script>";}
    echo "<script language='javascript'>window.location.href='dir_tree.php?c_f=".$c_f."'</script>";
}
if(!empty($_POST['button2']))
{echo "<script language='javascript'>window.location.href='dir_tree.php?c_f=".$c_f."'</script>";
}
?>
<form id="form1" name="form1" method="post" action="dir_delete.php?c_f=<?php echo $c_f;?>&c_dirname=<?php echo $c_dirname;?>">
    你确定要删除文件夹<?php echo $c_dirname?>？
    <input type="submit" name="button" id="button" value="是" />
    <input type="submit" name="button2" id="button2" value="否" />
</form>
</body>
</html>