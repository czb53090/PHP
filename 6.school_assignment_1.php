





































								echo "&nbsp";
								echo "1&nbsp";
								echo Combination($i, $j)."&nbsp";
							$j++; // 跳到下一行
							$row--;
							$sum = $j*($j-1)/2;
							// 因为第一行前面没有数即$sum为 0 所以不用计算,从第二行开始
							// 然后计算出第$j行之前的杨辉三角数值的个数
							// 输出每一行第一个数为1的情况，因为C($i,0)无法计算，除数不能为0
							continue 2;
							echo "&nbsp";
							echo "1&nbsp";
							echo "</br>";
							echo Combination($j-1, $k-1)."&nbsp";
							else
							for ($t=$row-2; $t>0; $t--) // 前面补空格
							if (0==$j)
						$k = $i-$sum; // $i-$sum 表示在$j行中的第几个数
						$string .= $text[$i];
						$temp[$asc]++;
						continue;
						echo "&nbsp";
						echo "</br>";
						else
						for ($j=$num-$i-1; $j>0; $j--) // 前面补空格
						for ($j=0; $j<=$i; $j++)
						if ($j == $k) //如果到了第$j行的最后一个数即第$k个数
						if (1 == $k) // 输出每一行第一个数为1的情况
						if (ord($text[$i]) == ord($text[$j]))
						{
						{
						}
						}
					 	$result *= $num;
					 do
					 {
					 } while ($num-- != $base && $num>0);
					$asc = ord($text[$i]);
					$num = $_POST['text2']+0;
					$num = $row*($row-1)/2; //总个数
					$result = 1;
					$row = $_POST['text3']+1; // 行数
					$row--;
					$string .= $text[$i];
					$temp[$i] = 0;
					echo "&nbsp";
					echo "&nbsp";
					echo "*";
					echo "*&nbsp";
					else
					for ($i=$j=1,$sum=0; $i<=$num; $i++)
					for ($i=0; $i<$num; $i++)
					for ($j=0; $j<$i; $j++)
					for ($t=$row-2; $t>0; $t--) // 前面补空格
					if (!$temp[$asc])
					return $result;
					return Factorial($a-$b+1, $a)/Factorial(1, $b);
					{
					{
					{
					}
					}
					}
				$len = strlen($text);
				$len = strlen($text);
				$string = "";
				$string = "";
				$text = $_POST['text1'];
				$text = $_POST['text1'];
				$text = $text;
				// 从$num开始循环乘以$num-1，每次递减1，直到$num==$base-1为止
				// 计算杨辉三角在第a行b列的数值,即计算排列组合 C(a-1, b-1)
				// 计算阶乘(其实不一定是阶乘)
				<?php
				<?php
				<input type="submit" name="submit2" class="button" />
				<input type="submit" name="submit3" class="button" />
				<input type="text" name="text2" class="mgtop10 hgt22" />
				<input type="text" name="text3" class="mgtop10 hgt22" />
				?>
				?>
				echo "</br>";
				echo "</br>";
				echo "<p class='red mgtop10'>处理后的字符串(方法一)：";
				echo "<p class='red'>原始字符串：".$text."</p>";
				echo "<p class='red'>处理后的字符串(方法二)：";
				echo $string."</p>";
				echo $string."</p>";
				for ($i=0; $i<$len; $i++)
				for ($i=0; $i<$len; $i++)
				for ($i=0; $i<128; $i++)
				for ($j=$num-$i; $j>0; $j--) // 前面补空格
				for ($j=$num-$i; $j>0; $j--) // 前面补空格
				for ($j=2*$i-1; $j>0; $j--)
				for ($j=4*$i-3; $j>0; $j--)
				function Combination($a, $b)
				function Factorial($base, $num)
				if (isset($_POST['submit2']))
				if (isset($_POST['submit3']))
				{
				{
				{
				{
				{
				{
				{
				}
				}
				}
				}
				}
				}
				}
			$num = 5;
			// 否则跳出此次循环，不进行连接
			// 居中对齐的版本,数量不符合题干
			// 并判断该下标处的值是否为0，是则填入1，并连接该字符到$string字符串后面
			// 数量与题干相同的版本，因为&nbsp不是占一个字符的位置，所以无法居中对齐
			// 方法一：对遍历到的每个字符都与前面的字符进行比较
			// 方法二：把出现的字符的ascii码作为数组$temp下标
			// 若不同则连接到$string字符串后面，否则不进行连接
			</div>
			</div>
			</p>
			</p>
			<?php
			<?php
			<?php
			<div class="txtcenter">
			<div class="txtcenter">
			<h1 class="mgtop10">输出结果：</h1>
			<h1 class="mgtop10">（测试方法二 单循环实现）</h1>
			<h1>1.字符串重复字符删除：</h1>
			<h1>2.杨辉三角：(方法一 双循环实现)</h1>
			<h1>请输入n的值：</h1>
			<input type="submit" name="submit1" class="button" />
			<input type="text" name="text1" class="mgtop10 wth400 hgt22" />
			<p class="mgtop10">
			<p class="mgtop10">
			?>
			?>
			?>
			border: 5px solid yellowgreen;
			color: blue;
			color: red;
			font-size: 20px;
			font-size: 25px;
			for ($i=1; $i<=$num; $i++)
			for ($i=1; $i<=$num; $i++)
			height: 22px;
			height: 25px;
			if (isset($_POST['submit1']))
			if (isset($_POST['submit1']))
			margin-top: 10px;
			margin: 0 auto 20px;
			margin: 0;
			padding: 0;
			padding: 20px;
			text-align: center;
			text-align: center;
			width: 400px;
			width: 60px;
			width: 800px;
			{
			{
			{
			{
			}
			}
			}
			}
		*{
		.box{
		.button{
		.hgt22{
		.mgtop10{
		.red{
		.txtcenter{
		.wth400{
		</div>
		</div>
		</p>
		<div class="box txtcenter">
		<div class="box">
		<h1>3.输出图案如下：</h1>
		<p>
		h1{
		p{
		}
		}
		}
		}
		}
		}
		}
		}
		}
		}
	</div>
	</form>
	</style>
	<div class="box">
	<form action="" method="post">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<style type="text/css">
	<title>Document</title>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
</body>
</head>
</html>
<body>
<head>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">