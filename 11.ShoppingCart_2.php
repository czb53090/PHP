<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>我的购物车</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			background-color: #dde;
		}
		table{
			width: 700px;
			margin: 30px auto;
			text-align: center;
			color: red;
			background-color: white;
		}
		tr{
			height: 40px;
		}
		tr.first td{
			height: 50px;
			background-color: skyblue;
			color: #d24;
		}
		tr.second td{
			background-color: greenyellow;
			color: blue;
			font-weight: bold;
		}
		td{
			border: 2px solid gold;
		}
		td:nth-child(1),td:nth-child(3){
			width: 200px;
		}
		td:nth-child(2),td:nth-child(4){
			width: 150px;
		}
		.txtsize{
			font-size: 14px;
			width: 50px;
			height: 22px;
			text-align: center;
			border: 2px solid skyblue;
		}
		.subsize{
			font-size: 14px;
			width: 50px;
			height: 24px;
			font-weight: bold;
			color: #324;
		}
	</style>

	<script type="text/javascript">
		function MM_changeProp(objId,x,theProp,theValue) { //v9.0
			var obj = null; with (document){
				if (getElementById)
					obj = getElementById(objId);
			}
			if (obj){
			    if (theValue == true || theValue == false)
			    	eval("obj.style."+theProp+"="+theValue);
			    else
			    	eval("obj.style."+theProp+"='"+theValue+"'");
	  		}
		}
    </script>
</head>
<body>
	<?php
	$b_name = "平凡的世界@活着@时间简史@高等数学@PHP程序设计@计算机组成原理";
    $price = "30.00@25.00@18.50@20.00@54.00@30.00";

    $filename = "11.ShoppingCart_2.txt";
    $file = fopen($filename, "a+");

    $counts = fgets($file);
    if ($counts == "")
    	$counts = "1@3@2@3@1@1";
    fclose($file);

    $arr_name = explode("@",$b_name);
    $arr_price = explode("@",$price);
    $arr_count = explode("@",$counts);

    if (isset($_POST['submit']))
    {
    	$bname = $_POST['bname'];
    	$bcount = $_POST['bcount'];

    	$key = array_search($bname, $arr_name);
    	$arr_count[$key] = $bcount;
    	$counts = implode("@", $arr_count);

    	$file = fopen($filename, "w");
    	fwrite($file, $counts);
    	fclose($file);
    }
	?>
	<table cellspacing="0">
		<tr class="first">
			<td colspan="4"><h2>我的购物车</h1></td>
		</tr>
		<tr class="second">
				<td>图书名称</td>
				<td>单价</td>
				<td>购买数量</td>
				<td>金额</td>
		</tr>
		<?php
		for ($i=0; $i<count($arr_name); $i++)
		{
			if ($arr_count[$i] > 0)
			{
		?>
		<tr class="book" id="book<?php echo $i ?>" onmousemove="MM_changeProp('book<? php echo $i;  ?>','','backgroundColor','orange','TR')" onmouseout="MM_changeProp('book<? php echo $i;  ?>','','backgroundColor','white','TR')">
			<td>
				<?php echo $arr_name[$i]?>
		    </td>
			<td>
				<?php echo $arr_price[$i]?>
		    </td>
			<td>
				<form action="" method="post">
					<input type="hidden" name="bname" value="<?php echo $arr_name[$i]; ?>" />
					<input type="text" name="bcount" class="txtsize" value="<?php echo $arr_count[$i]; ?>" />
					<input type="submit" name="submit" class="subsize" value="修改"/>
				</form>
			</td>
			<td>
				<?php echo $arr_count[$i]*$arr_price[$i]; ?>
		    </td>
	    </tr>
		<?php
			}
		}
		?>
	</table>
</body>
</html>