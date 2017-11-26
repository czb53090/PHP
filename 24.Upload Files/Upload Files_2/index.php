<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/27
 * Time: 19:41
 */

/*
 * 属性、函数速览：
 *
 * $_FILES['myFile']['name']：客户端上传文件原名
 * $_FILES['myFile']['type']：文件的类型
 * $_FILES['myFile']['size']：已上传文件的大小，单位：字节
 * $_FILES['myFile']['tmp_name']：临时文件名
 * $_FILES['myFile']['error']：文件上传相关的错误代码，0 则表示成功上传
 *
 *
 * move_uploaded_file(文件名，路标路径):用于将上传在临时目录下的文件移动到其他的目录下
 * */

// 获取后缀名
function get_suffix($filename)
{
    $i = strlen($filename) - 1;
    $arr_suffix = array();
    while ($filename[$i] != ".")
    {
        array_unshift($arr_suffix, $filename[$i]);
        $i--;
    }

    return implode($arr_suffix);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=GB2312">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: "Microsoft YaHei";
        }
        a {
            text-decoration: none;
        }
        .box-upload {
            width: 800px;
            height: 600px;
            margin: 20px auto;
        }
        .box-upload .upload-files {
            float: left;
            width: 478px;
            height: 598px;
            border: 1px solid #ccc;
            padding: 0 10px;
            overflow: auto;
        }
        .box-upload ul li {
            list-style: none;
            padding: 7px 10px;
            margin-top: -1px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ddd;
            position: relative;
        }
        .box-upload ul li input {
            width: 400px;
        }
        .box-upload ul li a {
            float: right;
            color: #aaa;
        }
        .box-upload ul li a:hover {
            color: #888;
        }
        .box-upload .ops {
            float: left;
            width: 300px;
            height: 113px;
            text-align: center;
        }
        .button {
            width: 90px;
            height: 30px;
            line-height: 30px;
            margin-top: 15px;
            outline-style: none;
            border-radius: 6px;
            border: 2px solid #ddd;
            cursor: pointer;
            font-size: 14px;
            background-color: #eee;
        }
        a.button {
            display: block;
            width: 86px;
            height: 26px;
            margin: 15px auto;
            color: #000;
        }
        .button:active {
            background-color: #eef;
        }
        .box-upload .log {
            float: left;
            width: 298px;
            height: 448px;
            padding-top: 35px;
            border: 2px solid #ccf;
            border-left-width: 0;
            border-radius: 0 5px 5px 0;
            position: relative;
        }
        .log-title {
            position: absolute;
            height: 30px;
            width: 280px;
            top: 0;
            left: 50%;
            margin-left: -140px;
            line-height: 30px;
            border-bottom: 1px solid #fdd;
            text-align: center;
            font-size: 18px;
        }
        .box-upload .output {
            float: left;
            width: 278px;
            height: 448px;
            padding: 0 10px;
            overflow: auto;
            word-break: break-all;
        }
        .box-upload .output p {
            line-height: 20px;
            font-size: 14px;
            color: #444;
        }
    </style>
    <script type="text/javascript">
        function $(id) { return document.getElementById(id); }

        window.onload = function()
        {
            var upload_files = $("upload-files");

            // 添加：
            var add_upload = $("add-upload");
            var files_count  =$("files-count");
            add_upload.onclick = function(upfiles, count)
            {
                return function()
                {
                    var li = document.createElement("li");
                    var input = document.createElement("input");
                    input.type = "file";
                    input.name = "myfile" + files_count.value;
                    count.value = parseInt(count.value) + 1;
                    var a = document.createElement("a");
                    a.href = "javascript:;";
                    a.innerHTML = "删除";
                    li.appendChild(input);
                    li.appendChild(a);
                    upfiles.appendChild(li);

                    // 删除新建的li：
                    a.onclick = function(parent)
                    {
                        return function()
                        {
                            parent.removeChild(this.parentNode);
                        }
                    } (upfiles)
                }
            } (upload_files, files_count);

            // 删除：
            var deletes = upload_files.getElementsByTagName("a");
            var deletes_len = deletes.length;

            for (var i = 0; i != deletes_len; i++)
            {
                deletes[i].onclick = function(parent)
                {
                    return function()
                    {
                        parent.removeChild(this.parentNode);
                    }
                } (upload_files)
            }
        }
    </script>
</head>
<body>
<div class="box-upload">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="upload-files">
            <ul id="upload-files">
                <li>
                    <input type="file" name="myfile0">
                    <a href="javascript:;">删除</a>
                </li>
                <li>
                    <input type="file" name="myfile1">
                    <a href="javascript:;">删除</a>
                </li>
                <li>
                    <input type="file" name="myfile2">
                    <a href="javascript:;">删除</a>
                </li>
            </ul>
        </div>

        <div class="ops">
            <p>
                <input type="submit" name="upload_sb" value="上传" class="button">
            </p>
            <p>
                <a href="javascript:;" class="button" id="add-upload">添加</a>
            </p>
        </div>
        <div class="log">
            <p class="log-title">状态输出</p>
            <div class="output">
                <?php

                if (!empty($_FILES))
                {
                    $upload_path = "files";
                    $files_count = $_POST['files_count'];
                    $count = 0;

                    for ($i = 0; $i < $files_count; $i++)
                    {
                        if (empty($_FILES['myfile'.$i]['name']))
                            continue;
                        else if ($_FILES['myfile'.$i]['size'] > 1024 * 1024
                            || !$_FILES['myfile'.$i]['size'])
                        {
                            echo "<p>".$_FILES['myfile'.$i]['name']." 上传失败，文件不大于1M！</p>";
                            continue;
                        }

//                        echo "文件原名：".$_FILES['myfile'.$i]['name']."， ";
//                        echo "文件类型：".$_FILES['myfile'.$i]['type']."， ";
//                        echo "文件大小：".$_FILES['myfile'.$i]['size']."， ";
//                        echo "临时文件名：".$_FILES['myfile'.$i]['tmp_name']."， ";
//                        echo "错误代码：".$_FILES['myfile'.$i]['error']."， ";
//                        echo "后缀名：".get_suffix($_FILES['myfile'.$i]['name'])."<br />";

                        $tmp_name = $_FILES['myfile'.$i]['tmp_name'];

                        $file_name = $_FILES['myfile'.$i]['name'];
                        $file_suffix = get_suffix($_FILES['myfile'.$i]['name']);
                        $full_name = $upload_path."\\".time().($count++).".".$file_suffix;

//                        echo $full_name."<br />";
                        move_uploaded_file($tmp_name, $full_name);
                        echo "<p>".$_FILES['myfile'.$i]['name']." 上传成功</p>";
                    }
                }
                ?>
            </div>
        </div>
        <input type="hidden" name="files_count" value="3" id="files-count">
    </form>
</div>
</body>
</html>
