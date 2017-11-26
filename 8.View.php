<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	$path = "8.DB/";
	$dr = opendir($path);

	while ($filen = readdir($dr)) {
		if ($filen!="." && $filen!="..")
		{
			$fs = fopen($path.$filen, "r");
			echo "<B>标题：</B>".fgets($fs)."</BR>";		
			echo "<B>作者：</B>".fgets($fs)."</BR>";		
			echo "<B>内容：</B><PRE>".fread($fs, filesize($path.$filen))."</PRE>";
			echo "<HR>";
			fclose($fs);		
		}
	}
	closedir($dr);
	?>
</body>
</html>