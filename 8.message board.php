<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	$path = "8.DB/"; // 指定存储路径
	$filename = "S".date("YmdHis").".dat";
	$fp = fopen($path.$filename, "w");
	fwrite($fp, $_POST["title"]."\n");
	fwrite($fp, $_POST["author"]."\n");
	fwrite($fp, $_POST["content"]."\n");
	fclose($fp);
	echo "留言发表成功！" ;
	echo "<a href='8.message board.html'>返回首页</a>";
	?>
</body>
</html>
