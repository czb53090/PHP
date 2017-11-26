<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<style type="text/css">
		.boxcenter{
			margin: 0 auto;
			text-align: center;
			border: 2px solid skyblue;
			width: 700px;
			height: 200px;
		}
		.textsmall{
			width: 50px;
		}
		h1{
			font-size: 20px;
		}
		p{
			font-size: 20px;
			color: red;
		}
		span{
			color: red;
		}
		label{
			font-weight: bold;
		}
	</style>
</head>
<body>
	<form method="post" action="">
		<div class="boxcenter">
			
				<h1><span>1.</span>商场搞优惠促销，优惠原则是“消费额每满100元，优惠10元”。</h1>
				<h1>请输入你需支付的金额：</h1>

				<input type="text" name="text1" />
				<input type="submit" name="submit1"/>

				<h1>折算后应支付的金额为：</h1>

				<p>
					<?php
					if (isset($_POST['submit1']))
					{
						$a = (float)$_POST['text1'];

						if ($a)
						{
							$b = (int)($a/100);

							if ($b)
							{
								echo $a." - ".($b*10)." = ".($a-=$b*10)."(元)";
							}
							else
							{
								echo ($a-=$b*10)."(元)";
							}
						}
						else
						{
							echo "输入有误！";
						}
					}
					?>
				</p>
			
		</div>
		<div class="boxcenter">
			<h1><span>2.(1).</span>表达式：n(n+1)(n+2)/XY</h1>
			<h1>请输入参数n、X、Y：</h2>

			<label for="text2">n:</label><input type="text" name="text2" id="text2" class="textsmall" />
			<label for="text3">X:</label><input type="text" name="text3" id="text3" class="textsmall" />
			<label for="text4">Y:</label><input type="text" name="text4" id="text4" class="textsmall" />
			<input type="submit" name="submit2"/>

			<p>
				<?php
				if (isset($_POST['submit2']))
				{
					$n = $_POST['text2'];
					$X = $_POST['text3'];
					$Y = $_POST['text4'];

					if ($n && $X && $Y) 
					{
						echo "$n($n+1)($n+2)/($X*$Y) = ";

						$result = $n*($n+1)*($n+2)/($X*$Y);

						echo $result;
					}
					else
					{
						echo "输入有误！";
					}
				}
				?>
			</p>
		</div>
		<div class="boxcenter">
			<h1><span>2.(2).</span>表达式：A + 1/xy^2</h1>
			<h1>请输入参数A、x、y：</h2>

			<label for="text5">A:</label><input type="text" name="text5" id="text5" class="textsmall" />
			<label for="text6">x:</label><input type="text" name="text6" id="text6" class="textsmall" />
			<label for="text7">y:</label><input type="text" name="text7" id="text7" class="textsmall" />
			<input type="submit" name="submit3"/>

			<p>
				<?php
				if (isset($_POST['submit3']))
				{
					$A = $_POST['text5'];
					$x = $_POST['text6'];
					$y = $_POST['text7'];

					if ($A && $x && $y) 
					{
						echo "$A + 1/($x*$y^2) = ";

						$result = $A + 1/($x*pow($y, 2));

						echo $result;
					}
					else
					{
						echo "输入有误！";
					}
				}
				?>
			</p>
		</div>
	</form>
</body>
</html>