<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/11 -- 2017/9/22
 * Time: 16:16 -- 15.53
 */

/* 函数速览：
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

// 问题：1.当目录名包含 #、+ 等符号和中文字符时用 Get 方法读不到正确的值，进入目录有异常
//      2.phpStudy不支持UTF-8编码，apache不支持GB2312编码

/* 函数定义 */

// 获取主文件名（index.php）
function get_main_file()
{
    $url = $_SERVER['PHP_SELF'];
    $filename = substr($url, strrpos($url, '/') + 1);

    return $filename;
}

// 获取当前目录
function get_cur_dir()
{
    if (isset($_GET['d']) && !empty($_GET['d']))
    {
        // 这个方法可以使Get到的变量转换为中文，但跳转中文目录还是会出错
//        echo urldecode($_GET['d']);
        $path = $_GET['d'];
    }
    else if (!($path = getcwd()))
    {
        alert_error("文件夹读取失败！");
        exit;
    }

    return $path;
}

// 显示文件、文件夹
function show_folder_file()
{
    global $path;
    global $main_file;

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
            $folder = strlen($path) == 3 && substr($path,1,0) == ":" ? $path.$f : $path."\\".$f;
            // 文件夹：
            echo "<li class='folder-li'>";
            echo    "<i class='icon-folder'></i>";
            echo    "<a href='".$main_file."?d=".$folder."' class='folder'><pre>".$f."</pre></a> ";
            // 操作控制：
            echo    "<div class='operation-box'>";
            echo        "<div class='dots'>。。。</div>";
            echo        "<div class='op' id='op'>";
            // 移动：
            echo            "<a href='move_dir.php?d=".$path."&move_folder=".$f."' class='move-ctrl'>移动到</a>";
            // 重命名：
            echo            "<a href='javascript:;' class='rename-ctrl'>重命名</a>";
            // 删除：
//            echo            "<a href='".$main_file."?d=".$path."&del=".$f."' class='delete-ctrl'>删除</a>";
            echo            "<a href='javascript:;' class='delete-ctrl'>删除</a>";
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
}

function is_character($char) // 用来判断是否为盘符，对路径的输出做显示调整
{
    $ascii = ord($char);
    return ($ascii > 64 && $ascii < 91) || ($ascii > 96 && $ascii < 123);
}

function show_prev_dir()
{
    global $path;

    $dirname = dirname($path);
    $basename = basename($path);

    // 对路径的输出做显示调整
    if (strlen($dirname) == 3)
        $dirname = substr($dirname, 0, 2);
    if (strlen($basename) == 1 && is_character($basename))
        $dirname = "";

    echo $dirname ? ("<a href='".get_main_file()."?d=".$dirname."'>") : "";
    echo $dirname."</a>".($dirname ? "\\".$basename : $basename.":");
}

// 弹出一个提示框
function alert_error($error_text)
{
    echo "<script type='text/javascript'> \n";
    echo    "show_bomb(\"".$error_text."\"); \n";
    echo "</script> \n";
}

// 递归删除文件夹下所有文件
function delete_folder_file($dir)
{
    $f_list = scandir($dir);

    foreach ($f_list as $f)
    {
        if ($f == "." || $f == "..")
            continue;
        else if (is_dir($dir."\\".$f))
        {
            if (!@rmdir($dir."\\".$f))
            {
                delete_folder_file($dir."\\".$f);
                if (!@rmdir($dir."\\".$f))
                    alert_error($dir."\\".$f." 目录删除失败！");
            }
        }
        else
            unlink($dir."\\".$f);
    }
}

?>

<?php
/*　全局变量初始化　*/

$path = get_cur_dir();
$main_file = get_main_file();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Simple File Manager</title>

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/cover_and_bomb.css">

    <script type="text/javascript" src="js/$().js"></script>
    <script type="text/javascript" src="js/client.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/show_bomb.js"></script>
</head>
<body>
<!-- cover 和 bomb-box 这两个盒子只能写在 php 代码要调用 js 代码（如方法alert_error()）
     来显现它们的上方，否则获取对象会出错 -->
<div class="cover" id="cover"></div>
<div class="bomb-box" id="bomb-box">
    <div class="top-bomb" id="drag-bomb">
        <span class="title-bomb">提示</span>
        <span class="close-bomb" id="close-bomb">&times;</span>
    </div>
    <p class="point-out" id="point-out"></p>
    <div class="ctrl-bomb">
        <button class="button-yes-bomb" id="button-yes-bomb">确定</button>
    </div>
</div>

<?php
/*　操作：　*/

// 创建文件夹：
if (isset($_POST['submit_cf']))
{

    $new_folder = trim($_POST['create_f']);
    // echo $new_folder;
    if (empty($new_folder))
        echo alert_error("请输入名称！");
    else if (!@mkdir($path."\\".$new_folder, 0777, false))
        echo alert_error("文件夹可能已经存在，创建失败！");
    else
        @header("Location:".$main_file."?d=".$path);
}

// 删除文件夹
if (isset($_GET['del']) && !empty($_GET['del']))
{
    $r = $_GET['del'];
    $flag = 1;
    if (!@rmdir($path."\\".$r))
    {
        // 目录非空，删除其下所有文件夹和文件
        delete_folder_file($path."\\".$r);
        if (!@rmdir($path."\\".$r))
        {
            alert_error($path."\\".$r." 目录删除失败！");
            $flag = 0;
        }
    }

    $flag ? @header("Location:".$main_file."?d=".$path) : "";
}

// 文件夹重命名：
if (isset($_GET['old_name']) && isset($_GET['new_name']))
{
    // 问题：在 empty() 函数里面调用 trim() 函数来测试空值，phpStudy会报错，Apache则不会
    if (!empty($_GET['old_name']) && !empty($_GET['new_name']))
    {
        $old_name = $_GET['old_name'];
        $new_name = trim($_GET['new_name']);
//            echo $old_name."  ".$new_name;

        if ($old_name == $new_name)
            alert_error("请输入不同的名称！");
        else if (!empty($new_name))
        {
            rename($path."\\".$old_name, $path."\\".$new_name);
            header("Location:".$main_file."?d=".$path);
        }
        else
            alert_error("请输入名称！");
    }
    else
        alert_error("重命名失败,请检查该名称是否合法！");
}
?>

<div class="main">
    <div class="create-folder-box">
        <form action="" method="post">
            <input type="text" name="create_f" class="create-f" placeholder=" 请输入文件夹名...">
            <input type="submit" name="submit_cf" class="submit-cf" value="创建">
        </form>
    </div>
    <p class="path" id="path">
        <i class="icon-tree"></i>
        <?php show_prev_dir(); ?>
    </p>
    <div class="dir">
        <ul>
            <?php show_folder_file(); ?>

            <div class="rename-box" id="rename-box">
                <input type="hidden" id="hidden-rn" value="<?php echo $main_file.'?d='.$path; ?>">
                <input type="text" class="text-rn" id="text-rn">
                <a href="javascript:;" id="submit-rn-yes" class="button-rn">&radic;</a>
                <a href="javascript:;" id="submit-rn-cancel" class="button-rn">&times;</a>
            </div>
        </ul>
    </div>
</div>

<div class="delete-box" id="delete-box">
    <div class="top-del" id="drag-del">
        <span class="title-del">确认删除</span>
        <span class="close-del" id="close-del">&times;</span>
    </div>
    <div class="ctrl-del">
        <a href="javascript:;" class="button-cancel-del" id="btn-cancel-del">取消</a>
        <form action="<?php echo $main_file.'?d='.$path.'&del=' ?>"
              method="post" id="form-del">
            <input type="submit" name="submit_del_yes" value="确定" class="button-yes-del" />
        </form>
    </div>
</div>
</body>
</html>


