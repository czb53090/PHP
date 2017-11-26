<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>目录管理</title>
    <style type="text/css">
        a:link {
            font-size: 14px;
            line-height: normal;
            color: #03F;
            text-decoration: none;
        }
        a:visited {
            font-size: 14px;
            color: #03F;
            text-decoration: none;
        }
        a:hover {
            font-size: 14px;
            color: #093;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php
if(!empty($_GET['c_f']))
{$c_dir=$_GET['c_f'];}//获取当前目录名称
else
{$c_dir=getcwd();}
chdir($c_dir);//改变当前工作目录
?>
<pre>
当前目录：</pre>
<pre>
<?php
echo "<img src='folder_c.png' width='16' height='16'>";
echo "<a href='dir_tree.php?c_f=".dirname($c_dir)."'>".dirname($c_dir)."</a>";
echo "\\".basename($c_dir)."<br>";
$list=scandir($c_dir);  //扫描当前目前中的条目
foreach($list as $k)
{   if($k!="."&&$k!="..")
{if(is_dir(realpath($k)))   //文件夹与文件区别显示
{   echo "   |-<img src='folder.png' width='12' height='14'>";
    echo "<a href='dir_tree.php?c_f=".realpath($k)."'>";
    printf("%'--20s",$k);
    echo "</a>";
    echo " <a href='dir_rename.php?c_f=".$c_dir."&c_dirname=".$k."'>[重命名]</a> ";
    echo "<a href='dir_delete.php?c_f=".$c_dir."&c_dirname=".$k."'>[删除]</a>";
    echo "<br>";}
else
{echo "   |-<img src='file.png' width='12' height='14'>".$k."<br>";}}
}
?>
</pre>
</body>
</html>
