<?php   /* �������� */
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 16:16
 */

/*
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

// ɾ�����������Ĺ��ܣ�����������һ���޸Ŀ�ɾ������һ��ȷ�Ͽ�
// ���⣺��λ�ȡ��ǰĿ¼��·�����������һ����session����
// �ƶ��ļ��У���ʱʵ���ƶ�����ǰĿ¼�µ�Ŀ¼��,��ʵ�֣���дһ�����ӣ���ͨ����һ��ҳ��ʵ�֣��ȷ���һ��Get������ԭĿ¼����
// ���ٵ����ǰҳ���µ�·��ʵ���ƶ�Ŀ¼��
// �༶�ƶ���Ҫ������Ŀ¼�����е�Ŀ¼������������չ�����
//            ������jsʵ�����ݵĴ���

// ���⣺1.��Ŀ¼������ #��+ �ȷ���ʱ��Get������������ȷ��ֵ
//      2.phpStudy�Ͱ汾��֧��UTF-8���루2017��֧�֣���apacheֻ֧��UTF-8����

// ��ȡ���ļ���
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
            echo    "<a href='".$main_file."?d=".$folder."' class='folder'>".$f."</a> ";
            // �������ƣ�
            echo    "<div class='operation-box'>";
            echo        "<div class='dots'>������</div>";
            echo        "<div class='op' id='op'>";
            // �ƶ���
            echo            "<a href='move_dir.php?d=".$path."&move_folder=".$f."' class='move-ctrl'>�ƶ���</a>";
            // ��������
            echo            "<a href='javascript:;' class='rename-ctrl'>������</a>";
            // ɾ����
            echo            "<a href='".$main_file."?d=".$path."&del=".$f."' class='delete-ctrl'>ɾ��</a>";
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

function is_character($char) // �����ж��̷�
{
    $ascii = ord($char);
    return ($ascii > 64 && $ascii < 91) || ($ascii > 96 && $ascii < 123);
}

function show_prev_dir()
{
    global $path;

    $dirname = dirname($path);
    $basename = basename($path);

    if (strlen($dirname) == 3)
        $dirname = substr($dirname, 0, 2);
    if (strlen($basename) == 1 && is_character($basename))
        $dirname = "";

    echo $dirname ? ("<a href='".get_main_file()."?d=".$dirname."'>") : "";
    echo $dirname."</a>".($dirname ? "\\".$basename : $basename.":");
}
function alert_error($error_text)
{
    echo "<script language='JavaScript'>";
    echo "alert('".$error_text."');";
    echo "</script>";
}

function echo_path_hid()
{
    global $path;

    echo "<input type='hidden' id='hid-cur-dir' value='".$path."'>";
}


?>

<?php
    $path = get_cur_dir();
    $main_file = get_main_file();


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
            header("Location:".$main_file."?d=".$path);
    }

    // ɾ���ļ���
    if (isset($_GET['del']) && !empty($_GET['del']))
    {
        $r = $_GET['del'];
        if (!@rmdir($path."\\".$r))
        {
            alert_error("��Ŀ¼��Ϊ�գ�ɾ��ʧ�ܣ�");
        }
        else
            header("Location:".$main_file."?d=".$path);
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

            if (!empty($new_name))
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Simple File Manager</title>

    <link rel="stylesheet" href="css/index.css">
    <script type="text/javascript" src="js/$().js"></script>
    <script type="text/javascript" src="js/client.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
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
        <form action="<?php echo $main_file.'?del='.$path ?>"
              method="post" id="form-del">
            <input type="submit"  name="submit_del_yes" value="ȷ��"
                   onclick="return submit_del();" class="button-yes-del" />
        </form>
    </div>
</div>
<?php echo_path_hid(); ?>
<div class="cover" id="cover"></div>
</body>
</html>

