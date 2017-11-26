<?php   /* 函数定义 */
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 16:16
 */

/*
 * opendir($dir)
 * is_dir($dir)
 * readdir(打开的目录指针)                失败返回false
 * scandir(目录路径，[排序方式])           所有文件名、文件夹名扫描到一个数组中
 * mkdir(目录路径，[权限模式][，是否多级])  $dir, 0777, false;多级：父级目录不存在自动创建
 * rmdir(目录路径)                       失败返回false
 * rename("原名称","新名称")              失败返回false，还可以实现移动文件夹的操作
 * getcwd()                             返回当前工作的文件夹路径，失败返回false
 * chdir(目录路径)                       将当前工作文件夹重定向到新的文件夹
 * closedir(已打开的目录指针)             用于关闭一个已打开的文件夹
 * disk_free_space(文件夹路径)           返回文件夹中的可用空间（字节，浮点数）
 * disk_total_space(文件夹路径)          返回文件夹的总空间大小（字节，浮点数）
 * basename(文件夹路径)                  获取指定路径中最后一级文件夹的名字，失败返回false
 * dirname(文件夹路径)                   获取指定路径中去掉最后一级文件夹的名字后的路径
 * */

// 删除和重命名的功能：重命名弹出一个修改框，删除弹出一个确认框
// 难题：如何获取当前目录的路径，解决方法一：用session保存
// 移动文件夹：暂时实现移动到当前目录下的目录中,简单实现（另写一个例子）：通过另一个页面实现，先发送一个Get方法的原目录数据
// ，再点击当前页面下的路径实现移动目录的
// 多级移动需要遍历该目录下所有的目录并可以以树形展开浏览
//            可以用js实现数据的传输

// 问题：当目录名包含 #、+ 等符号时Get方法读不到正确的值

// 获取主文件名
function get_main_file()
{
    $url = $_SERVER['PHP_SELF'];
    $filename = substr($url, strrpos($url, '/') + 1);

    return $filename;
}

// 获取当前目录
function get_cur_dir()
{
    if (!empty($_GET['d']))
    {
        $path = $_GET['d'];
    }
    else if (!($path = getcwd()))
    {
        echo "文件夹读取失败！";
        exit;
    }

    return $path;
}

// 显示文件、文件夹
function show_dir()
{
    $path = get_cur_dir();
    $main_file = get_main_file();

    $f_list = scandir($path);

    $i = 0;
    $files = array();
    foreach ($f_list as $f)
    {
        if ($f == ".")
            continue;
        else if ($f == "..")
        {
            echo "<li><a href='".$main_file."?d=".dirname($path)."'>";
            echo $f." [返回上级]</a></li>";
        }
        else if (is_dir($path."\\".$f))
        {
            // 生成下一级目录
            $folder = strlen($path) == 3 ? $path.$f : $path."\\".$f;
            // 文件夹：
            echo "<li class='folder-li'>";
            echo    "<i class='icon-folder'></i>";
            echo    "<a href='".$main_file."?d=".$folder."' class='folder'>".$f."</a> ";
            // 操作控制：
            echo    "<div class='operation-box'>";
            echo        "<div class='dots'>。。。</div>";
            echo        "<div class='op' id='op'>";
            // 移动：
            echo            "<a href='javacsript:;' class='remove-ctrl'>移动到</a>";
            // 重命名：
            echo            "<a href='javascript:;' class='rename-ctrl'>重命名</a>";
            // 删除：
            echo            "<a href='".$main_file."?d=".$path."&del=".$f."' class='delete-ctrl'>删除</a>";
            echo        "</div>";
            echo    "</div>";
            echo "</li>";
        }
        else
        {
            $i++;
            array_unshift($files, $f);
        }
    }
    while ($i != 0)
        echo "<li><i class='icon-file'></i><span>".$files[--$i]."</span></li>";


    /*$dir = opendir($path);

    while ($f = readdir($dir))
    {
        echo $f."</br>";
    }

    closedir($dir);*/

}



?>

<?php
    $path = get_cur_dir();
    $main_file = get_main_file();


    // 创建文件夹：
    if (isset($_POST['submit_cf']))
    {
        $new_folder = $_POST['create_f'];
        // echo $new_folder;
        if (!@mkdir($path."\\".$new_folder, 0777, false))
        {
            echo "<script language='JavaScript'>";
            echo "alert('文件夹可能已经存在，创建失败！');";
            echo "</script>";
        }
        else
            header("Location:".$main_file."?d=".$path);
    }

    // 删除文件夹
    if (!empty($_GET['del']))
    {
        $r = $_GET['del'];
        if (!@rmdir($path."\\".$r))
        {
            echo "<script language='JavaScript'>";
            echo "alert('此目录不为空，删除失败！');";
            echo "</script>";
        }
        else
            header("Location:".$main_file."?d=".$path);
    }

    // 文件夹重命名：
    if (isset($_GET['old_name']) && isset($_GET['old_name']))
    {
        if (!empty(trim($_GET['old_name'])) && !empty(trim($_GET['old_name'])))
        {
            $old_name = $_GET['old_name'];
            $new_name = $_GET['new_name'];
//            echo $old_name."  ".$new_name;

            rename($path."\\".$old_name, $path."\\".$new_name);

            header("Location:".$main_file."?d=".$path);
        }
        else
        {
            echo "<script language='JavaScript'>";
            echo "alert('重命名失败！');";
            echo "</script>";
        }
    }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Simple File Manager</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        body {
            font-family: "Microsoft YaHei", "SimSun";
            background-color: #eff4f8;
        }
        ul, ol {
            list-style: none;
        }
        a {
            text-decoration: none;
        }
        a:link, a:visited, a:hover, a:active {
            color: #00f;
        }
        .main {
            width: 800px;
            height: 520px;
            margin: 20px auto;
        }
        .main .create-folder-box {
            width: 100%;
            height: 30px;
            text-align: right;
        }
        .main .create-folder-box .create-f {
            height: 20px;
            font-size: 14px;
            padding-left: 5px;
        }
        .main .create-folder-box .submit-cf {
            width: 40px;
            height: 22px;
            font-size: 12px;
        }
        .main .path {
            padding-left: 22px;
            font-size: 16px;
            line-height: 26px;
            position: relative;
        }
        .main .path i.icon-tree {
            width: 22px;
            height: 22px;
            position: absolute;
            top: 3px;
            left: 0;
            background: url(img/folder_c.png) no-repeat;
        }
        .main .dir {
            height: 500px;
            border: 1px solid #d8dfea;
            overflow: auto;
            padding-left: 5px;
            background-color: #fff;
            border-radius: 5px;
        }
        .main .dir ul {
            position: relative;
            padding-right: 5px;
        }
        .main .dir ul li {
            height: 28px;
            line-height: 28px;
            font-size: 14px;
            padding-left: 24px;
            position: relative;
            border-top: 1px solid #f2f6fd;
            border-bottom: 1px solid #f2f6fd;
            position: relative;
            margin-top: -1px;
        }
        .main li.folder-choose {
            position: relative;
            z-index: 1;
            border-top: 1px solid #daebfe;
            border-bottom: 1px solid #daebfe;
            background-color: #f6faff;
            padding-left: 120px;
        }
        .main li .operation-box {
            float: right;
            width: 50px;
            height: 28px;
            position: relative;
            color: #5fa1ff;
            text-align: center;
        }
        .main li .operation-box .dots {
            width: 50px;
            height: 28px;
            line-height: 20px;
            cursor: pointer;
            display: none;
        }
        .main li .operation-box .op {
            position: absolute;
            top: 24px;
            right: 0;
            width: 80px;
            height: 78px;
            z-index: 9999;
            border: 1px solid #c0d9fe;
            border-radius: 4px;
            background-color: #ffffff;
            display: none;
        }
        .main li .operation-box .op a {
            display: block;
            width: 80px;
            height: 26px;
            line-height: 26px;
            font-size: 14px;
        }
        .main .dir li a.delete-ctrl,
        .main .dir li a.rename-ctrl,
        .main .dir li a.move-ctrl {
            color: #3b8cff;
            float: right;
            font-size: 12px;
        }
        .main .dir li i.icon-folder, .main .dir li i.icon-file {
            height: 22px;
            width: 22px;
            position: absolute;
            top: 5px;
            left: 4px;
        }
        .main .dir li i.icon-folder {
            background: url(img/folder.png) no-repeat;
        }
        .main .dir li i.icon-file {
            background: url(img/file.png) no-repeat;
        }
        .rename-box {
            position: absolute;
            top: 0;
            left: 24px;
            z-index: 10;
            width: 680px;
            height: 26px;
            padding-top: 2px;
            background-color: #fff;
            line-height: 28px;
            display: none;
        }
        .rename-box .text-rn {
            float: left;
            width: 230px;
            height: 20px;
            border: 2px solid #a3cafe;
            border-radius: 3px;
            font-size: 14px;
            padding-left: 4px;
            margin-right: 5px;
        }
        .rename-box .button-rn {
            float: left;
            font-family: "SimSun";
            width: 20px;
            height: 20px;
            line-height: 20px;
            margin-right: 5px;
            text-align: center;
            border: 1px solid #cae1fd;
            background-color: #f0f8fd;
            color: #3c8cff;
            font-size: 12px;
            font-weight: 700;
            outline-style: none;
            cursor: pointer;
        }

        .delete-box {
            position: absolute;
            width: 520px;
            height: 350px;
            top: 50%;
            left: 50%;
            margin-top: -175px;
            margin-left: -260px;
            border-radius: 5px;
            z-index: 9999;
            border: 1px solid #ccc;
            background-color: #fff;
            /*display: none;*/
        }
        .delete-box .top-rv {
            height: 39px;
            padding-left: 10px;
            line-height: 39px;
            background-color: #f7faff;
            border-bottom: 1px solid #c4dbfe;
            cursor: move;
        }
        .delete-box .top-rv .title-rv {
            font-size: 14px;
            color: #424e67;
            padding-left: 10px;
        }
        .delete-box .top-rv .close-rv {
            float: right;
            width: 30px;
            height: 30px;
            text-align: center;
            margin-top: 4px;
            margin-right:  10px;
            line-height: 30px;
            font-size: 24px;
            font-weight: 700;
            color: #5f7094;
            cursor: pointer;
        }
        .delete-box .path-box-rv {
            width: 500px;
            height: 248px;
            margin: 10px auto;
            border: 1px solid #f2f2f2;
            background-color: #ccc;
        }
        .delete-box .ctrl-rv {
            height: 40px;
            padding-right: 10px;
            text-align: center;
        }
        .delete-box .ctrl-rv .button-yes-rv,
        .delete-box .ctrl-rv .button-cancel-rv{
            float: right;
            height: 28px;
            width: 100px;
            margin-left: 20px;
            line-height: 30px;
            border: 1px solid #4e97ff;
            border-radius: 5px;
            font-size: 14px;
        }
        .delete-box .ctrl-rv .button-yes-rv {
            background-color: #4e97ff;
            color: #fff;
        }
        .delete-box .ctrl-rv .button-cancel-rv {
            color: #77afff;
        }
    </style>
    <script type="text/javascript" src="js/index_2.js"></script>
</head>
<body>
<div class="main">
    <div class="create-folder-box">
        <form action="" method="post">
            <input type="text" name="create_f" class="create-f" placeholder=" 请输入文件夹名...">
            <input type="submit" name="submit_cf" class="submit-cf" value="创建">
        </form>
    </div>
    <p class="path" id="path">
        <i class="icon-tree"></i>
        <?php
        $dirname = dirname(get_cur_dir());
        $basename = basename(get_cur_dir());

        if (strlen($dirname) == 3)
            $dirname = substr($dirname, 0, 2);
        if (strlen($basename) == 1)
            $dirname = "";

        echo $dirname ? ("<a href='".get_main_file()."?d=".$dirname."'>") : "";
        echo $dirname."</a>".($dirname ? "\\".$basename : $basename.":");
        ?>
    </p>
    <div class="dir">
        <ul>
            <?php show_dir(); ?>

            <div class="rename-box" id="rename-box">
                <input type="hidden" id="hidden-rn" value="<?php echo $main_file.'?d='.$path; ?>">
                <input type="text" class="text-rn" id="text-rn">
                <a href="javascript:;" id="submit-rn-yes" class="button-rn">√</a>
                <a href="javascript:;" id="submit-rn-cancel" class="button-rn">×</a>
            </div>
        </ul>
    </div>
</div>
<div class="remove-box">
    <div class="top-rv" id="drag-rv">
        <span class="title-rv">移动到</span>
        <span class="close-rv">×</span>
    </div>
    <div class="path-box-rv">
        <p class="path-cu-rv"></p>
        <ul>

        </ul>
    </div>
    <div class="ctrl-rv">
        <a href="javascript:;" class="button-cancel-rv" id="btn-cancel-rv">取消</a>
        <a href="javascript:;" class="button-yes-rv" id="btn-yes-rv">确定</a>
    </div>
</div>
<div class="delete-box">

</div>

</body>
</html>

