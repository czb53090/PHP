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
			$arr1 = $arr2 = array();

			//初始化二维数组 $arr1 和 $arr2
			for ($i=0; $i<4; $i++)
				for ($j=0; $j<4; $j++)
					$arr1[$i][$j] = $arr2[$i][$j] = 0;
			$arr1[0][2] = 1;
			$arr1[2][1] = 1;

			echo "<h1 class='mgt20'>初始数组：</h1>";
			echo "<p class='mgt20'>";
			for ($i=0; $i<4; $i++) // 输出转换前的数组 $arr1
			{
				for ($j=0; $j<4; $j++)
					echo $arr1[$i][$j]."&nbsp";
				echo "</br>";
			}
			echo "</p>";

			echo "<div class='cl h2 gray mgt20'></div>"; //分割线

			// 数组转换过程：
			for ($i=0; $i<4; $i++) // 遍历行
				for ($j=0; $j<4; $j++) // 遍历列
					if ($arr1[$i][$j]) // 判断下标为($i,$j)的元素的值是否为1
						for ($k=0; $k<4; $k++)
							$arr2[$i][$k] = $arr2[$k][$j] = 1;
							// 将$arr2中下标为($i,$j)处所对应的行和列中的元素的值都置为1

			echo "<h1 class='mgt20'>转换后的数组：</h1>";
			echo "<p class='mgt20'>";
			for ($i=0; $i<4; $i++) // 输出转换后的数组 $arr2
			{
				for ($j=0; $j<4; $j++)
					echo $arr2[$i][$j]."&nbsp";
				echo "</br>";
			}
			echo "</p>";
		?>
	</div>
	
</body>
</html>