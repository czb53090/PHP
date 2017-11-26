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
	h1{
		font-size: 25px;
		color: blue;
	}
	p{
		font-size: 20px;
		color: red;
	}
	.cl{
		clear: both;
	}
	.h2{
		height: 2px;
		_font-size: 0;
	}
	.gray{
		background-color: gray;
	}
	.tac{
		text-align: center;
	}
	.mgt20{
		margin-top: 20px;
	}
	</style>
</head>
<body>
	<div class="tac">
		<?php
		//初始化
		$arr = array();
		for ($i=0; $i<4; $i++)
			for ($j=0; $j<4; $j++)
				$arr[$i][$j] = 0;
		$arr[0][2] = 1;
		$arr[2][1] = 1;

		echo "<h1 class='mgt20'>初始数组：</h1>";
		echo "<p class='mgt20'>";
		for ($i=0; $i<4; $i++)
		{
			for ($j=0; $j<4; $j++)
				echo $arr[$i][$j]."&nbsp";
			echo "</br>";
		}
		echo "</p>";

		echo "<div class='cl h2 gray mgt20'></div>";

		// 数组转换过程：
		$x = $y = 0;

		for ($i=0; $i<4; $i++) // 检查第一行和检查第一列
		{
			if ($arr[0][$i])
				$x = 1;
			if ($arr[$i][0])
				$y = 1;
		}

		// 若$arr[$i][$j]为1，则分别设置第一行第$j列和第一列第$i行的元素值为1
		for ($i=1; $i<4; $i++)
			for ($j=1; $j<4; $j++)
				if ($arr[$i][$j])
					$arr[$i][0] = $arr[0][$j] = 1;

		for ($i=0; $i<4; $i++)
		{
			if ($arr[0][$i])
				for ($j=0; $j<4; $j++)
					$arr[$j][$i] = 1;

			if ($arr[$i][0])
				for ($j=0; $j<4; $j++)
					$arr[$i][$j] = 1;
		}

		if ($x)
			for ($j=0; $j<4; $j++)
				$arr[0][$j] = 1;
		if ($y)
			for ($i=0; $i<4; $i++)
				$arr[$i][0] = 1;

		echo "<h1 class='mgt20'>转换后的数组：</h1>";
		echo "<p class='mgt20'>";
		for ($i=0; $i<4; $i++)
		{
			for ($j=0; $j<4; $j++)
				echo $arr[$i][$j]."&nbsp";
			echo "</br>";
		}
		echo "</p>";
		?>
	</div>
</body>
</html>