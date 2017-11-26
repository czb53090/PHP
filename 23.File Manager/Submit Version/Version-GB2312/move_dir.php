<?php
/* �������� */
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
    if (isset($_GET['new_dir']) && !empty($_GET['new_dir']))
    {
        $path = $_GET['new_dir'];
    }
    else if (isset($_GET['d']) && !empty($_GET['d']))
    {
        $path = $_GET['d'];
    }
    else if (!($path = getcwd()))
    {
        echo "�ļ��ж�ȡʧ�ܣ�";
        exit;
    }

    return $path;
}

function get_old_dir()
{
    if (isset($_GET['d']) && !empty($_GET['d']))
        $path = $_GET['d'];
    return $path;
}

function get_move_folder()
{
    if (isset($_GET['move_folder']) && !empty($_GET['move_folder']))
        $move_folder = $_GET['move_folder'];
    return $move_folder;
}

// ��ʾ�ļ����ļ���
function show_folder()
{
    global $new_dir;
    global $old_dir;
    global $move_folder;
    global $main_file;
//    echo $path;

    $f_list = scandir($new_dir);

    foreach ($f_list as $f)
    {
        if ($f == "." || $f == "..")
            continue;
        else if (is_dir($new_dir."\\".$f))
        {
            // ������һ��Ŀ¼
            $folder = strlen($new_dir) == 3 ? $new_dir.$f : $new_dir."\\".$f;
            // �ļ��У�
            echo "<li class='folder-li'>";
            echo    "<i class='icon-folder'></i>";
            echo    "<a href='".$main_file."?d=".$old_dir."&";
            echo        "move_folder=".$move_folder."&";
            echo        "new_dir=".$folder."' class='folder'>".$f."</a> ";
            echo "</li>";
        }
    }
}

function echo_old_path_hid()
{
    global $old_dir;

    echo "<input type='hidden' id='hid-old-dir' value='".$old_dir."'>";
}

function is_character($char) // �����ж��Ƿ�Ϊ�̷�����·�����������ʾ����
{
    $ascii = ord($char);
    return ($ascii > 64 && $ascii < 91) || ($ascii > 96 && $ascii < 123);
}

function show_prev_dir()
{
    global $new_dir;
    global $old_dir;
    global $move_folder;

    $dirname = dirname($new_dir);
    $basename = basename($new_dir);

    if (strlen($dirname) == 3)
        $dirname = substr($dirname, 0, 2);
    if (strlen($basename) == 1 && is_character($basename))
        $dirname = "";

    echo $dirname ? ("<a href='".get_main_file()."?d=".$old_dir."&".
            "move_folder=".$move_folder."&".
            "new_dir=".$dirname."'>") : "";
    echo $dirname."</a>".($dirname ? "\\".$basename : $basename.":");
}

function alert_error($error_text)
{
    echo "<script type='text/javascript'> \n";
    echo    "show_bomb(\"".$error_text."\"); \n";
    echo "</script> \n";
}

?>

<?php
/* ȫ�ֱ������� */
$main_file = get_main_file();
$new_dir = get_cur_dir();
$old_dir = get_old_dir();
$move_folder = get_move_folder();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Document</title>

    <link rel="stylesheet" href="css/move_dir.css">
    <link rel="stylesheet" href="css/cover_and_bomb.css">

    <script type="text/javascript" src="js/$().js"></script>
    <script type="text/javascript" src="js/client.js"></script>
    <script type="text/javascript" src="js/move_dir.js"></script>
    <script type="text/javascript" src="js/show_bomb.js"></script>
</head>
<body>
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
/* ���� */

// �ƶ�Ŀ¼��
if (isset($_POST['submit_mv_yes']))
{
    // �Ƚ���ͬ�¾�·����ͬ �� �Ƚϸ��ļ������Ƿ������·����֮�� ���¾�·���ȽϺ����·���Ƿ�һ��
//    echo $new_dir."  ".$old_dir;
//    echo strstr($new_dir, $move_folder, true)."  ";
//    echo strstr($old_dir, $move_folder, true);
    if ($new_dir == $old_dir || (strstr($new_dir, $move_folder) &&
            strstr($new_dir, $move_folder) == strstr($old_dir, $move_folder)))
        alert_error("��ѡ��Ҫ�ƶ�������ЧĿ¼��");
    else
    {
        if (!@rename($old_dir."\\".$move_folder, $new_dir."\\".$move_folder))
            alert_error("�ƶ�ʧ�ܣ������ļ����Ѵ��ڣ�");
        else
            header("location:index.php?d=".$old_dir);
    }
}
?>
<div class="move-box">
    <div class="top-mv" id="drag-mv">
        <span class="title-mv">�ƶ���</span>
        <span class="close-mv" id="close-mv">&times;</span>
    </div>
    <div class="path-box-mv">
        <p class="cur-mv">
            <i class="icon-tree"></i>
            <?php show_prev_dir(); ?>
        </p>
        <ul>
            <?php show_folder(); ?>
        </ul>
    </div>
    <div class="ctrl-mv">
        <a href="javascript:;" class="button-cancel-mv" id="btn-cancel-mv">ȡ��</a>
        <form action="<?php echo $main_file.'?d='.$old_dir.'&move_folder='.$move_folder.'&new_dir='.$new_dir; ?>"
              method="post">
            <input type="submit"  name="submit_mv_yes" value="ȷ��" class="button-yes-mv" />
        </form>
        <!--            <a href="javascript:;" class="button-yes-mv" id="btn-yes-mv">ȷ��</a>-->
    </div>
</div>
<?php echo_old_path_hid(); ?>
</body>
</html>