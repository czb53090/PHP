function Check_All()
{
	if (!Check_radio_checkbox('sex'))
	{
		alert("请选择你的性别！");
		return false;
	}
	if(!Check_text_select('age', "请选择", "请选择"))
	{
		alert("请选择你的年龄！");
		return false;
	}
	if(!Check_text_select('xueli', "请选择", "请选择"))
	{
		alert("请选择你的学历！");
		return false;
	}
	if(!Check_text_select('major', "", ""))
	{
		alert("请输入你的专业！");
		return false;
	}
	if (!Check_radio_checkbox('ganbu'))
	{
		alert("请选择你是否为学生干部！");
		return false;
	}
	if (!Check_radio_checkbox('hobit[]'))
	{
		alert("至少选择一项兴趣爱好！");
		return false;
	}
	if (!Check_radio_checkbox('reed_rate'))
	{
		alert("请选择你阅读的频率！");
		return false;
	}
	if (!Check_radio_checkbox('work_time'))
	{
		alert("请选择你兼职的情况！");
		return false;
	}

	return true;
}

function Check_text_select(text_id, textContent, setContent)
{
	var major = document.getElementById(text_id);

	if (major.value.replace(" ", "").trim() == textContent)
	{
		major.value = setContent;
		return false;
	}
	else
	{
		return true;
	}
}

function Check_radio_checkbox(r_c_id)
{
	var sex = document.getElementsByName(r_c_id);
	var flag = 0;
	
	for(var i=0; i<sex.length; i++)
		if (sex.item(i).checked == true)
			flag = 1;
			
	if (!flag)
		return false;
	else
		return true;
}