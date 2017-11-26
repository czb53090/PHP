<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		table{
			width: 500px;
			margin: 0 auto;
			text-align: center;
		}
		tr{
			height: 30px;
		}
		tr.first td{
			background-color: skyblue;
		}
		tr.second td{
			background-color: greenyellow;
		}
		td{
			border: 2px solid gold;
		}
		td:nth-child(4n-3),td:nth-child(4n-1){
			width: 160px;
		}
		td:nth-child(4n-2){
			width: 80px;
		}
		td:nth-child(4n){
			width: 100px;
		}
		.txtsize{
			font-size: 10px;
			width: 50px;
		}
		.subsize{
			width: 40px;
		}
	</style>
</head>
<body>
	<?php
	$b_name="平凡的世界@活着@时间简史@高等数学@PHP程序设计@计算机组成原理";
    $price="30.00@25.00@18.50@20.00@54.00@30.00";
    $counts= "1@1@2@2@3@2";

    $arr_name=explode("@",$b_name);
    $arr_price=explode("@",$price);
    $arr_count=explode("@",$counts);

    if (isset($_POST['submit']))
    {
    	$bname = $_POST['bname'];
    	$bcount = $_POST['bcount'];

    	$key = array_search($bname, $arr_name);
    	$arr_count[$key] = $bcount;
    	$counts = implode("@", $arr_count);
    }
	?>
	<table cellspacing="0">
		<tr class="first">
			<td colspan="4">我的购物车</td>
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
		<tr class="book">
			<td>
				<?php echo $arr_name[$i]?>
			</td>
			<td>
				<?php echo $arr_price[$i]?>
			</td>
			<form action="" method="post">
				<td>
				<input type="hidden" name="bname" value="<?php echo $arr_name[$i]; ?>" />
				<input type="text" name="bcount" class="txtsize" value="<?php echo $arr_count[$i]; ?>" />
				<input type="submit" name="submit" class="subsize" vlaue="修改"/>
			</td>
			</form>
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