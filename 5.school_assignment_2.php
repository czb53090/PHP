<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<style type="text/css">
	.boxcenter{
			margin: 20px auto;
			text-align: center;
			border: 2px solid skyblue;
			width: 700px;
			height: 160px;
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
	</style>
</head>
<body>
	<form action="" method="post">
		<div class="boxcenter">
			<h1><span>1.</span>请输入你消费的金额（元）：</h1>
			<input type="text" name="text_1" />
			<input type="submit" name="submit_1"/>

			<h1>欲支付金额：</h1>
			<p>
				<?php
				if (isset($_POST['submit_1']))
				{
					$cost = $_POST['text_1'];
					if (!is_numeric($cost) || ($cost+0) <=0)
						echo "输入有误，请重新输入！";
					else
					{
						if ($cost > 500)
							$discount = 7.5;
						elseif($cost >= 401)
							$discount = 8;
						elseif($cost >= 301)
							$discount = 8.5;
						elseif($cost >= 100)
							$discount = 9;
						else
							$discount = 0;

						echo "原消费： ".$cost."(元)， ";
						if (!$discount)
							echo "100元以下，无优惠。";
						else
							echo "打".$discount."折： ".($cost*$discount/10)."(元)";
					}	
				}
				?>
			</p>
		</div>

		<div class="boxcenter">
			<h1><span>2.</span>请输入一个三位整数：</h1>
			<input type="text" name="text_2" />
			<input type="submit" name="submit_2"/>

			<h1>逆序输出为：</h1>
			<p>
				<?php
				if (isset($_POST['submit_2']))
				{
					$num = $_POST['text_2'];
					if (!is_numeric($num) || is_float($num+1))
						echo "输入有误，请重新输入！";
					else
					{
						if ($num>999 || $num<100)
						{
							echo "输入的整数不在范围内！";
						}
						else
						{
							$result = 0;
							echo $num." ===> ";
							do {
								$t = $num % 10;
								$num = intval($num/10);

								$result = $result*10 + $t;
							} while ($num != 0);

							echo $result;
						}
					}
				}
				?>
			</p>
		</div>

		<div class="boxcenter">
			<h1><span>3.</span>输出所有位数为3的整数的水仙花数：</h1>
			<p>
				<?php
				for ($i=100; $i<1000; $i++)
				{
					$t = $i;
					$result = 0;

					do {
						$k = $t % 10;
						$t /= 10;

						$sum = pow($k, 3);

						$result += $sum;
					} while ($t != 0);

					if ($result == $i)
						echo $result."、";
				}
				?>
			</p>
		</div>
	</form>
</body>
</html>