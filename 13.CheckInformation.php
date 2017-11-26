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
		body{
			padding-top: 40px;
		}
		.table1{
			width: 400px;
			margin: 0 auto;
			background-color: skyblue;
			border: 2px solid #ddd;
		}
		.table1 tr{
			height: 40px;
		}
		.table1 label{
			padding-left: 20px;
		}
		.table1 .submit1{
			width: 60px;
			height: 25px;
		}
		.box1{
			position: relative;
			padding-left: 20px;
			padding-top: 40px;
			width: 376px;
			height: 100px;
			border: 2px solid #ddd;
			margin: 0 auto;
			background-color: #dbeeec;
			color: red;
		}
		.box1 p{
			margin-bottom: 10px;
		}
		.h3{
			position: absolute;
			border: 2px solid #acc;
			top: -10px;
			left: 0;
			background-color: white;
			padding: 2px;
			color: blue;
		}
		.z1{
			z-index: 1;
		}
		.z999{
			z-index: 999;
		}
	</style>
</head>
<body>
	<form action="" method="post">
		<table class="table1">
			<tr>
				<td><label for="username">用户名：</label></td>
				<td><input type="text" id="username" name="username" /></td>
			</tr>
			<tr>
				<td><label for="password">密码：</label></td>
				<td><input type="password" id="password" name="password" /></td>
			</tr>
			<tr>
				<td><label for="phone">手机号码：</label></td>
				<td><input type="text" id="phone" name="phone" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="注册" class="submit1" onclick="restore()" /></td>
			</tr>
		</table>
	
	</form>
	<div class="box1">
		<?php
			function CheckSpace($a, $len){
				for ($i=0; $i<$len; $i++)
				{
					if ($a[$i] == ' ')
						return false;
				}
				return true;
			}

			$flag = 0;
			if (isset($_POST['submit']))
			{
				$username = trim($_POST['username'], ' ');
				$usernamelen = strlen($username);
				$phone = trim($_POST['phone'], ' ');
				$phonelen = strlen($phone);
				$password = $_POST['password'];
				$passwordlen = strlen($password);

				$flag1 = $flag2 = $flag3 = 0;
			

				// 检查用户名
				if (!$username) // 是否为空
					echo "<p>用户名不能为空！</p>";
				else if ($usernamelen < 20) // 检查长度
				{
					if (CheckSpace($username, $usernamelen)) // 是否包含空格
					{
						if (ord($username[0])>=48 && ord($username[0])<=58)
							echo "<p>用户名不能以数字开头！</p>";
						else
							$flag1 = 1; // checked
					}
					else
						echo "<p>用户名不能包含空格！</p>";
				}
				else
					echo "<p>用户名过长,应小于20个字符！</p>";



				// 检查密码
				if (!$password)
					echo "<p>密码不能为空！</p>";
				else if ($passwordlen>=6 && $passwordlen<=16)
				{
					if (CheckSpace($password, $passwordlen))
						$flag2 = 1; // checked
					else
						echo "<p>密码不能包含空格！</p>";
				}
				else
					echo "<p>密码长度不符合，请输入6到16位密码！</p>";



				// 检查手机号
				if (!$phone)
					echo "<p>手机号码不能为空！</p>";
				else
				{
					if (!is_numeric($phone) || $phone[0]=='-')
						echo "<p>手机号码格式有误！</p>";
					else
					{
						if($phonelen != 11)
							echo "<p>请输入11位手机号码！</p>";
						else
						{
							$flag3_1 = 1;
							//检验数字里面是否包含小数点
							for ($i=0; $i<$phonelen; $i++)
							{
								if ($phone[$i]=='.')
								{
									$flag3_1 = 0;
									break;
								}
							}

							/*手机格式：
							+86是属于中国的意思，国际拨打号码时候要加上86在加上国内号码
							移动：134、135、136、137、138、139、150、151、152、157、158、159、182、183、184、187、188、178(4G)、147(上网卡)；
							联通：130、131、132、155、156、185、186、176(4G)、145(上网卡)；
							电信：133、153、180、181、189 、177(4G)；*/
							
							if ($flag3_1)
							{
								$check = array("134","135","136","137","138","139","150","151",
									"152","157","158","159","182","183","184","187","188","178",
									"147","130","131","132","155","156","186","176","145","133",
									"153","180","181","189","177");
								$pre = substr($phone, 0, 3);
								
								$flag3_2 = 1;
								foreach ($check as $k)
								{
									if (!strcmp($pre, $k))
									{
										$flag3_2 = 0;
										break;
									}
								}
								if (!$flag3_2)
									$flag3 = 1; // checked
								else
									echo "<p>请输入有效的手机号码！</p>";
							}
							else
							{
								echo "<p>手机号码不能有小数！</p>";
							}
						}
					}
					
				}

				$flag = ($flag1 && $flag2 && $flag3)? 1 : 0;
				if ($flag)
				{
					echo "<p>您的用户名：".$username."</p>";
					echo "<p>您的密码：".$password."</p>";
					echo "<p>您的手机：".$phone."</p>";
					echo '<h3 class="h3 z999">验证成功：</h3>';
				}
			}
		?>
		<h3 class="h3 z1">验证结果：</h3>
	</div>
</body>
</html>