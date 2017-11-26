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
			width: 400px;
			background-color: skyblue;
			position: absolute;
			left: 50%;
			margin-left: -200px;
			top: 20px;
		}
		.submit{
			width: 60px;
			height: 20px;
		}
		tr{
			height: 30px;
		}
		label{
			padding-left: 15px;
		}
	</style>
</head>
<body>
	<form action="" method="post">
		<table>
			<tr>
				<td><label for="password1">密码：</label></td>
				<td><input type="password" name="password1" id="password1" /></td>
			</tr>
			<tr>
				<td><label for="password2">确认密码：</label></td>
				<td><input type="password" name="password2" id="password2" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" class="submit" /></td>
			</tr>
		</table>
	</form>
	<?php
	if (isset($_POST['submit'])) // 没检测、验证输入的内容
	{
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
	
		echo '<script type="text/javascript">';
		if (strcmp($password1, $password2))
			echo 'alert("两次输入的密码不一致！") ';
		else
			echo 'alert("登陆成功")';
		echo '</script>';

	}

	?>
</body>
</html>