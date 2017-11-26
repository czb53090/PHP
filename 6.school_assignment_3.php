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
		.box{
			margin: 0 auto 20px;
			padding: 20px;
			width: 800px;
			border: 5px solid yellowgreen;
		}
		h1{
			text-align: center;
			font-size: 25px;
			color: blue;
		}
		p{
			font-size: 20px;
		}
		.txtcenter{
			text-align: center;
		}
		.mgtop10{
			margin-top: 10px;
		}
		.red{
			color: red;
		}
		.wth400{
			width: 400px;
		}
		.hgt22{
			height: 22px;
		}
		.button{
			width: 60px;
			height: 25px;
		}
	</style>
</head>
<body>
	<form action="" method="post">
		<div class="box txtcenter">
			<h1>1.字符串重复字符删除：</h1>
			<input type="text" name="text1" class="mgtop10 wth400 hgt22" />
			<input type="submit" name="submit1" class="button" />

			<h1 class="mgtop10">输出结果：</h1>

			<?php
			// 方法一：对遍历到的每个字符都与前面的字符进行比较
			// 若不同则连接到$string字符串后面，否则不进行连接
			if (isset($_POST['submit1']))
			{
				$text = $_POST['text1'];

				echo "<p class='red'>原始字符串：".$text."</p>";
				echo "<p class='red mgtop10'>处理后的字符串(方法一)：";
				
				$len = strlen($text);
				$string = "";
				for ($i=0; $i<$len; $i++)
				{
					for ($j=0; $j<$i; $j++)
						if ($text[$i] == $text[$j])
							continue 2;

					$string .= $text[$i];
				}

				echo $string."</p>";
			}
			?>


			<?php
			// 方法二：把出现的字符的ascii码作为数组$temp下标
			// 并判断该下标处的值是否为0，是则填入1，并连接该字符到$string字符串后面
			// 否则跳出此次循环，不进行连接
			if (isset($_POST['submit1']))
			{
				$text = (string)$_POST['text1'];

				echo "<p class='red'>处理后的字符串(方法二)：";

				$temp = array();
				for ($i=0; $i<128; $i++)
				{
					$temp[$i] = 0;
				}

				//计算字符串长度
				$text .= ' ';
				$len = 0;
				while ($text[$len++] != ' ');

				$string = "";
				for ($i=0; $i<$len; $i++) 
				{
					$asc = ord($text[$i]);

					if (!$temp[$asc])
					{
						$temp[$asc]++;
						$string .= $text[$i];
					}
					else
						continue;
				}

				echo $string."</p>";
			}
			?>
		</div>
		

		<div class="box">
			<h1>2.杨辉三角：(方法一 双循环实现)</h1>
			<h1>请输入n的值：</h1>

			<div class="txtcenter">
				<input type="text" name="text2" class="mgtop10 hgt22" />
				<input type="submit" name="submit2" class="button" />
			</div>
			
			<p class="mgtop10 txtcenter">
				<?php
				// 计算阶乘(其实不一定是阶乘)
				// 从$num开始循环乘以$num-1，每次递减1，直到$num==$base-1为止
				function Factorial($base, $num)
				{
					$result = 1;
					
					 do
					 {
					 	$result *= $num;
					 } while ($num-- != $base && $num>0);

					return $result;
				}
				// 计算阶乘_2，递归实现
				function Factorial_2($base, $num)
				{
					if ($num == $base)
						return $base;
					else
						return $num*Factorial_2($base, $num-1);
				}

				// 计算杨辉三角在第a行b列的数值,即计算排列组合 C(a-1, b-1)
				function Combination($a, $b)
				{
					return Factorial_2($a-$b+1, $a)/Factorial_2(1, $b);
				}

				if (isset($_POST['submit2']))
				{
					$num = $_POST['text2']+0;
					
					if (is_numeric($num) && !is_float($num+0) && $num>0 && $num<=16)
					{
						for ($i=0; $i<$num; $i++)
						{

							for ($j=0; $j<=$i; $j++)
							{
								if (0==$j)
								// 输出每一行第一个数为1的情况，因为C($i,0)无法计算，除数不能为0
									echo "1&nbsp";
								else
									echo Combination($i, $j)."&nbsp";
							}
							echo "</br>";
						}
					}
					else
					{
						echo "输入的数值有误，请输入小于17的正整数";
					}
				}
				?>
			</p>

			<h1 class="mgtop10">（测试方法二 单循环实现）</h1>

			<div class="txtcenter">
				<input type="text" name="text3" class="mgtop10 hgt22" />
				<input type="submit" name="submit3" class="button" />
			</div>

			<p class="mgtop10 txtcenter">
				<?php
				if (isset($_POST['submit3']))
				{
					$row = $_POST['text3']+1; // 行数

					if (is_numeric($row) && !is_float($row+0) && $row>1 && $row<=17)
					{
						$num = $row*($row-1)/2; //总个数

						for ($i=$j=1,$sum=0; $i<=$num; $i++)
						{
							$k = $i-$sum; // $i-$sum 表示在$j行中的第几个数

							if (1 == $k) // 输出每一行第一个数为1的情况
								echo "1&nbsp";
							else
								echo Combination($j-1, $k-1)."&nbsp";

							if ($j == $k) //如果到了第$j行的最后一个数即第$k个数
							{
								$j++; // 跳到下一行
								// 然后计算出第$j行之前的杨辉三角数值的个数
								// 因为第一行前面没有数即$sum为 0 所以不用计算,从第二行开始
								$sum = $j*($j-1)/2; 
								echo "</br>";
							}
						}
					}
					else
					{
						echo "输入的数值有误，请输入小于17的正整数";
					}
				}
				?>
			</p>
		</div>
	</form>

	<div class="box">
		<h1>3.输出图案如下：</h1>
			<?php
			$num = 5;

			echo "<p class='txtcenter'>";
			for ($i=1; $i<=$num; $i++)
			{
				for ($j=2*$i-1; $j>0; $j--)
					echo "*";

				echo "</br>";
			}
			echo "</p>";

			// 居中对齐的版本,数量不符合题干
			echo "<p>";
			for ($i=1; $i<=$num; $i++)
			{
				for ($j=$num-$i; $j>0; $j--) // 前面补空格
					echo "&nbsp";

				for ($j=2*$i-1; $j>0; $j--)
					echo "*";

				echo "</br>";
			}
			echo "</p>";
			?>
	</div>
</body>
</html> 