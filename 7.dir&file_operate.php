<?php
$dir = ".";
$dir_res = opendir($dir);

// 读取目录中的文件
while ($filen = readdir($dir_res))
	echo $filen."</br>";
closedir($dir_res);

// 创建目录
$dir = "Test/";
if (!is_dir($dir))
	mkdir($dir);

// 写入文件
$file = fopen("Test\\file.txt", "w");

fwrite($file, "Hello World!\n");
fwrite($file, "This is a test!\n");

fclose($file);

// 复制文件
$filename1 = "Test\\file.txt";
$filename2 = "Test\\file.bak";
copy($filename1, $filename2);
// file.txt复制到file.bak

// 读取文件
$file = fopen("Test\\file.txt", "r");

//echo fgetc($file); //读出一个字符
//echo fgets($file); //读出一行
$filename = "Test\\file.txt";
$filesize = filesize($filename);
echo fread($file, $filesize); // 读出全部内容

fclose($file);

// 删除文件
unlink($filename);
unlink($filename2);

// 删除目录
if (is_dir($dir))
	rmdir($dir);
?>