<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/11 -- 2017/9/22
 * Time: 16:16 -- 15.53
 */

/* ����������
 * opendir($dir)
 * is_dir($dir)
 * readdir(�򿪵�Ŀ¼ָ��)                ʧ�ܷ���false
 * scandir(Ŀ¼·����[����ʽ])           �����ļ������ļ�����ɨ�赽һ��������
 * mkdir(Ŀ¼·����[Ȩ��ģʽ][���Ƿ�༶])  $dir, 0777, false;�༶������Ŀ¼�������Զ�����
 * rmdir(Ŀ¼·��)                       ʧ�ܷ���false
 * rename("ԭ����","������")              ʧ�ܷ���false��������ʵ���ƶ��ļ��еĲ���
 * getcwd()                             ���ص�ǰ�������ļ���·����ʧ�ܷ���false
 * chdir(Ŀ¼·��)                       ����ǰ�����ļ����ض����µ��ļ���
 * closedir(�Ѵ򿪵�Ŀ¼ָ��)             ���ڹر�һ���Ѵ򿪵��ļ���
 * disk_free_space(�ļ���·��)           �����ļ����еĿ��ÿռ䣨�ֽڣ���������
 * disk_total_space(�ļ���·��)          �����ļ��е��ܿռ��С���ֽڣ���������
 * basename(�ļ���·��)                  ��ȡָ��·�������һ���ļ��е����֣�ʧ�ܷ���false
 * dirname(�ļ���·��)                   ��ȡָ��·����ȥ�����һ���ļ��е����ֺ��·��
 * */

// ���⣺1.��Ŀ¼������ #��+ �ȷ��ź������ַ�ʱ�� Get ������������ȷ��ֵ������Ŀ¼���쳣
//      2.phpStudy��֧��UTF-8���룬apache��֧��GB2312����

/* �������� */

// ��ȡ���ļ�����index.php��
function get_main_file()
{
    $url = $_SERVER['PHP_SELF'];
    $filename = substr($url, strrpos($url, '/') + 1);

    return $filename;
}

// ��ȡ��ǰĿ¼
function get_cur_dir()
{
    if (isset($_GET['d']) && !empty($_GET['d']))
    {
        // �����������ʹGet���ı���ת��Ϊ���ģ�����ת����Ŀ¼���ǻ����
//        echo urldecode($_GET['d']);
        $path = $_GET['d'];
    }
    else if (!($path = getcwd()))
    {
        alert_error("�ļ��ж�ȡʧ�ܣ�");
        exit;
    }

    return $path;
}

// ��ʾ�ļ����ļ���
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
            echo $f." [�����ϼ�]</a></li>";
        }
        else if (is_dir($path."\\".$f))
        {
            // ������һ��Ŀ¼
            $folder = strlen($path) == 3 && substr($path,1,0) == ":" ? $path.$f : $path."\\".$f;
            // �ļ��У�
            echo "<li class='folder-li'>";
            echo    "<i class='icon-folder'></i>";
            echo    "<a href='".$main_file."?d=".$folder."' class='folder'><pre>".$f."</pre></a> ";
            // �������ƣ�
            echo    "<div class='operation-box'>";
            echo        "<div class='dots'>������</div>";
            echo        "<div class='op' id='op'>";
            // �ƶ���
            echo            "<a href='move_dir.php?d=".$path."&move_folder=".$f."' class='move-ctrl'>�ƶ���</a>";
            // ��������
            echo            "<a href='javascript:;' class='rename-ctrl'>������</a>";
            // ɾ����
//            echo            "<a href='".$main_file."?d=".$path."&del=".$f."' class='delete-ctrl'>ɾ��</a>";
            echo            "<a href='javascript:;' class='delete-ctrl'>ɾ��</a>";
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

function is_character($char) // �����ж��Ƿ�Ϊ�̷�����·�����������ʾ����
{
    $ascii = ord($char);
    return ($ascii > 64 && $ascii < 91) || ($ascii > 96 && $ascii < 123);
}

function show_prev_dir()
{
    global $path;

    $dirname = dirname($path);
    $basename = basename($path);

    // ��·�����������ʾ����
    if (strlen($dirname) == 3)
        $dirname = substr($dirname, 0, 2);
    if (strlen($basename) == 1 && is_character($basename))
        $dirname = "";

    echo $dirname ? ("<a href='".get_main_file()."?d=".$dirname."'>") : "";
    echo $dirname."</a>".($dirname ? "\\".$basename : $basename.":");
}

// ����һ����ʾ��
function alert_error($error_text)
{
    echo "<script type='text/javascript'> \n";
    echo    "show_bomb(\"".$error_text."\"); \n";
    echo "</script> \n";
}

// �ݹ�ɾ���ļ����������ļ�
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
                    alert_error($dir."\\".$f." Ŀ¼ɾ��ʧ�ܣ�");
            }
        }
        else
            unlink($dir."\\".$f);
    }
}

?>

<?php
/*��ȫ�ֱ�����ʼ����*/

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
<!-- cover �� bomb-box ����������ֻ��д�� php ����Ҫ���� js ���루�緽��alert_error()��
     ���������ǵ��Ϸ��������ȡ�������� -->
<div class="cover" id="cover"></div>
<div class="bomb-box" id="bomb-box">
    <div class="top-bomb" id="drag-bomb">
        <span class="title-bomb">��ʾ</span>
        <span class="close-bomb" id="close-bomb">&times;</span>
    </div>
    <p class="point-out" id="point-out"></p>
    <div class="ctrl-bomb">
        <button class="button-yes-bomb" id="button-yes-bomb">ȷ��</button>
    </div>
</div>

<?php
/*����������*/

// �����ļ��У�
if (isset($_POST['submit_cf']))
{

    $new_folder = trim($_POST['create_f']);
    // echo $new_folder;
    if (empty($new_folder))
        echo alert_error("���������ƣ�");
    else if (!@mkdir($path."\\".$new_folder, 0777, false))
        echo alert_error("�ļ��п����Ѿ����ڣ�����ʧ�ܣ�");
    else
        @header("Location:".$main_file."?d=".$path);
}

// ɾ���ļ���
if (isset($_GET['del']) && !empty($_GET['del']))
{
    $r = $_GET['del'];
    $flag = 1;
    if (!@rmdir($path."\\".$r))
    {
        // Ŀ¼�ǿգ�ɾ�����������ļ��к��ļ�
        delete_folder_file($path."\\".$r);
        if (!@rmdir($path."\\".$r))
        {
            alert_error($path."\\".$r." Ŀ¼ɾ��ʧ�ܣ�");
            $flag = 0;
        }
    }

    $flag ? @header("Location:".$main_file."?d=".$path) : "";
}

// �ļ�����������
if (isset($_GET['old_name']) && isset($_GET['new_name']))
{
    // ���⣺�� empty() ����������� trim() ���������Կ�ֵ��phpStudy�ᱨ��Apache�򲻻�
    if (!empty($_GET['old_name']) && !empty($_GET['new_name']))
    {
        $old_name = $_GET['old_name'];
        $new_name = trim($_GET['new_name']);
//            echo $old_name."  ".$new_name;

        if ($old_name == $new_name)
            alert_error("�����벻ͬ�����ƣ�");
        else if (!empty($new_name))
        {
            rename($path."\\".$old_name, $path."\\".$new_name);
            header("Location:".$main_file."?d=".$path);
        }
        else
            alert_error("���������ƣ�");
    }
    else
        alert_error("������ʧ��,����������Ƿ�Ϸ���");
}
?>

<div class="main">
    <div class="create-folder-box">
        <form action="" method="post">
            <input type="text" name="create_f" class="create-f" placeholder=" �������ļ�����...">
            <input type="submit" name="submit_cf" class="submit-cf" value="����">
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
        <span class="title-del">ȷ��ɾ��</span>
        <span class="close-del" id="close-del">&times;</span>
    </div>
    <div class="ctrl-del">
        <a href="javascript:;" class="button-cancel-del" id="btn-cancel-del">ȡ��</a>
        <form action="<?php echo $main_file.'?d='.$path.'&del=' ?>"
              method="post" id="form-del">
            <input type="submit" name="submit_del_yes" value="ȷ��" class="button-yes-del" />
        </form>
    </div>
</div>
</body>
</html>


