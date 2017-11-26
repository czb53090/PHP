<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        table{
            margin: 0 auto;
            width: 500px;
            text-align: center;

        }
        td{
            border: 1px solid skyblue;
        }
        .operate{
            width: 15px;
        }
        .tac{
            text-align: center;
        }
    </style>
    <script type="text/javascript">
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
    </script>
</head>
<body>
<?php
    // 读取cookie数据
    $str_bname = $_COOKIE["bname"];
    $str_bcount = $_COOKIE["bcount"];
    $str_bprice = $_COOKIE["bprice"];
    $arr_bname = explode("@", $str_bname);
    $arr_bcount = explode("@", $str_bcount);
    $arr_bprice = explode("@", $str_bprice);
    // 增加数量
    if (isset($_POST['add']))
    {
        $bname = $_POST['bname'];
        $key = array_search($bname, $arr_bname);
        $arr_bcount[$key] += 1;
    }
    // 减少数量
     if (isset($_POST['sub']))
    {
        $bname = $_POST['bname'];
        $key = array_search($bname, $arr_bname);
        $arr_bcount[$key] -= 1;
        if ($arr_bcount[$key] <= 0)
        {
            array_splice($arr_bname, $key, 1);
            array_splice($arr_bcount, $key, 1);
            array_splice($arr_bprice, $key, 1);
        }
    }
    // 更新cookie
    $str_bname = implode("@", $arr_bname);
    $str_bcount = implode("@", $arr_bcount);
    $str_bprice = implode("@", $arr_bprice);
    setcookie("bname", $str_bname, time()+3600);
    setcookie("bcount", $str_bcount, time()+3600);
    setcookie("bprice", $str_bprice, time()+3600);
    $_COOKIE['bname'] = $str_bname;
    $_COOKIE['bcount'] = $str_bcount;
    $_COOKIE['bprice'] = $str_bprice;
?>
<table cellspacing="5">
    <tr>
        <td colspan="4">我的购物车</td>
    </tr>
    <tr>
        <td>图书名</td>
        <td>单价</td>
        <td>数量</td>
        <td>金额</td>
    </tr>
<?php
    $arr_bname = explode("@", $_COOKIE['bname']);
    $arr_bcount = explode("@", $_COOKIE['bcount']);
    $arr_bprice = explode("@", $_COOKIE['bprice']);
    $num = count($arr_bname);
    for ($i=1; $i<$num; $i++)
    {
    ?>
    <tr id="tr<?php echo $i; ?>" onmousemove="MM_changeProp('tr<?php echo $i; ?>','','backgroundColor','yellow','TR')" onmouseout="MM_changeProp('tr<?php echo $i; ?>','','backgroundColor','white','TR')">
        <td><?php echo $arr_bname[$i]; ?></td>
        <td><?php echo $arr_bprice[$i]; ?></td>
        <td>
            <form action="shopping cart.php" method="post" accept-charset="utf-8">
                <input class="operate" type="submit" name="sub" value="-" />
                <?php echo $arr_bcount[$i]; ?>
                <input class="operate" type="submit" name="add" value="+" />
                <input type="hidden" name="bname" value="<?php echo $arr_bname[$i]; ?>"/>
            </form>
        </td>
        <td>
            <?php echo $arr_bcount[$i]*$arr_bprice[$i]; ?>
        </td>
    </tr>
<?php } ?>
</table>
<?php echo "<p class='tac'><a href='index.php'>继续买书</a></p>";?>
</body>
</html>