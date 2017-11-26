<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
</head>

<script language="javascript">
	function check_word()
	{
		if (doucument.getElementById("username").value == "")
		{
			alert("请输入用户名！");
			return false;
		}
		if (doucument.getElementById("password").value == "")
		{
			alert("请输入密码！");
			return false;
		}
		if (doucument.getElementById("password_2").value == "")
		{
			alert("请输入确认密码！");
			return false;
		}
		if (doucument.getElementById("password").value != doucument.getElementById("password_2").value)
		{
			alert("两次输入的密码不一致！");
			return false;
		}
	}
</script>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="291" border="0" align="center">
    <tr>
      <td colspan="2"><div align="center">注册</div></td>
    </tr>
    <tr>
      <td width="90" height="24">用户名：</td>
      <td width="191"><label>
        <input name="username" type="text" id="username" />
      </label></td>
    </tr>
    <tr>
      <td height="24">密码：</td>
      <td><label for="textfield"></label>
      <input type="text" name="password" id="password" /></td>
    </tr>
    <tr>
      <td height="26">确认密码：</td>
      <td><label for="textfield"></label>
      <input type="text" name="password_2" id="password_2" /></td>
    </tr>
    <tr>
      <td height="25">&nbsp;</td>
      <td><label>
        <input name="button" type="submit" id="button" value="注册" onclick = "return check_word()" />
      </label></td>
    </tr>
  </table>
</form>

<?php
	if (isset($_POST['button']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		echo "您的用户名：".$username.'<br>';
		echo "您的密码：".$password;
	}
?>
	
</body>
</html>
