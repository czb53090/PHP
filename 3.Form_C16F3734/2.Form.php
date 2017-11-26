<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<link type="text/css" rel="stylesheet" href="2.Form.css"></link>

</head>

<body>
<div id="div_1">
	<img src="Form.jpg" id="img_1" />
    <table id="table_1">
    	<tr>
    		<td id="td_1" colspan="3">
          	<label>你提交的问卷信息</label>
        	</td>
   		</tr>
 		<tr>
    		<td></td>
        	<td>性别：</td>
        	<td>
            	<?php echo $_POST['sex'] ?>
            </td>
      	</tr>
     	<tr>
     		<td></td>
        	<td>年龄：</td>
        	<td>
            	<?php echo $_POST['age'] ?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>学历：</td>
            <td>
                <?php echo $_POST['xueli'] ?>
            </td>
      	</tr>
     	<tr>
     		<td></td>
            <td>专业：</td>
            <td>
                <?php echo $_POST['major'] ?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>是否学生干部：</td>
            <td>
              <?php echo $_POST['ganbu'] ?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>兴趣爱好：</td>
            <td>
            	<?php 
                	$array = $_POST['hobit']; 
                	for ($i=0; $i<count($array)-1; $i++)
                		echo $array[$i]."、"; 
                	echo $array[$i];
                	/*
                  		$inte = "";
                  		foreach($_POST['hobit'] as $k)
                  		{
					  		inte = inte."、".$k;
				  		}
					*/
              	?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>阅读频率：</td>
            <td>
            	<?php echo $_POST['reed_rate'] ?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td>是否兼职：</td>
            <td>
                <?php echo $_POST['work_time'] ?>
            </td>
    	</tr>
        <tr>
        	<td colspan="3"></td>
        </tr>
		</table>
</div>
</body>
</html>
