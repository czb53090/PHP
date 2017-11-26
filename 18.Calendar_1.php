<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>简易日历</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: "SimSun";
        }
        .calendar {
            width: 543px;
            height: 420px;
            margin: 30px auto;
        }
        .calendar .left_part {
            float: left;
            width: 391px;
            height: 416px;
            border: 2px solid #5CAEFF;
        }
        .left_part .calendar_top {
            width: 371px;
            height: 22px;
            padding: 10px;
        }
        .left_part .calendar_top select {
            float: left;
            height: 20px;
            border: 1px solid #ddd;
        }
        .left_part .calendar_top .select_y {
            width: 72px;
        }
        .left_part .calendar_top .select_m {
            width: 57px;
        }
        .left_part .calendar_top input {
            float: left;
            width: 20px;
            height: 20px;
            background-color: #FAFAFA;
            font-family: 'pingfang sc';
            font-weight: bold;
            color: #999;
            font-size: 14px;
        }
        .left_part .calendar_top input.sub {
            border: 1px solid #ddd;
            border-right-width: 0;
        }
        .left_part .calendar_top input.add {
            border: 1px solid #ddd;
            border-left-width: 0;
        }
        .left_part .calendar_top input.return_today {
            height: 22px;
            width: 71px;
            background-color: #8CB1EB;
            border: 1px solid #88B4F6;
            color: #fff;
            font-size: 12px;
            line-height: 20px;
        }
        .left_part .calendar_table {
            float: left;
            width: 371px;
            height: 364px;
            padding: 0 10px 10px 10px;
            text-align: center;
        }
        .left_part .calendar_table table {
            width: 371px;
            height: 364px;
        }
        .left_part .calendar_table tr {
            margin-top: -1px;

        }
        .left_part .calendar_table tr.first{
            background-color: #F5F9FF;
        }
        .left_part .calendar_table tr.first td {
            border-top: 1px solid #5CAEFF;
            height: 33px;
            line-height: 34px;
            font-weight: normal;
        }
        .left_part .calendar_table tr.first td span {
            font-size: 16px;
        }
        .left_part .calendar_table td {
            width: 54px;
            height: 54px;
            font-weight: bold;
            float: left;
            margin-left: -1px;
            /* padding: 5px 0; */
        }
        .red
        {
            color: #E02D2D;
        }
        .left_part .calendar_table td a {
            display: block;
            width: 52px;
            height: 54px;
            line-height: 53px;
            text-decoration: none;
            font-size: 18px;
            color: #000;
            border: 1px solid #fff;
            border-top: 1px solid #ddd;
            position: relative;
        }
        .left_part .calendar_table td:nth-child(6n) a,
        .left_part .calendar_table td:nth-child(7n) a
        {
            color: #E02D2D;
        }
        .left_part .calendar_table td a:hover {
            border: 1px solid #19B955;
            z-index: 2;
        }
        .left_part .calendar_table td a:active {
            border: 1px solid #FD8795;
            color: #159B47;
        }
        .calendar_table td a.click {
            /* 当a被点击时 */
            background-color: #F5FEF9;
            border: 1px solid #19B955;
            color: #159B47;
            z-index: 1;
        }
        .left_part .calendar_table td.local_day a {
            /* 把class加在td防止a的class被js代码改写 */
            /* 该样式可重叠掉上面的，因为权重比其高，用于高亮今天的日期 */
            background-color: #FFBB00;
            color: #fff;
            border: 1px solid #FFBB00;
        }
        .left_part .calendar_table td.notCurrentMonthDay a {
            color: #C2C2C2;
        }
        .right_part {
            float: left;
            width: 130px;
            height: 145px;
            padding: 0 8px 0 10px;
            background-color: #5CAEFF;
            text-align: center;
            border-radius: 0 7px 7px 0;
        }
        .right_part .date {
            font-size: 14px;
            line-height: 48px;
            color: #fff;
            font-family: "Microsoft YaHei";
        }
        .right_part .day {
            margin: 0 auto;
            width: 70px;
            height: 70px;
            color: #fff;
            background-color: #FFBB00;
            border-radius: 5px;
            border-right: 2px solid #55A1EC;
            border-bottom: 3px solid #4C90D3;
            font: 700 42px/70px 'SimSun';
        }
        .mgr11 {
            margin-right: 11px;
        }
        .mgr13 {
            margin-right: 13px;
        }
    </style>
</head>
<body>
<?php
    // 获取当前系统时间
    // 加条件防止有些系统本地时间不准确
    $local_year = date("Y")<2017? 2017 : date("Y");
    $local_month = date("m");
    $local_day = date("d");
    // 给出年份的最大、最小值
    $min_year = 1900;
    $max_year = 2099;


    $y = isset($_POST['select_y'])? $_POST['select_y'] : $local_year;
    if (isset($_POST['sub_y']))
        if ($y > $min_year)
            $y -= 1;
    if (isset($_POST['add_y']))
        if ($y < $max_year)
            $y += 1;
    $m = isset($_POST['select_m'])? $_POST['select_m'] : $local_month;
    if (isset($_POST['sub_m']))
        if ($m > 1)
            $m -= 1;
        else
        {
            $m = 12;
            $y -= 1;
        }
    if (isset($_POST['add_m']))
        if ($m < 12)
            $m += 1;
        else
        {
            $m = 1;
            $y += 1;
        }

    $hidden = isset($_POST['hidden'])&&$_POST['hidden']!="" ? $_POST['hidden'] : ($y==$local_year&&$m==$local_month ? $local_day : 1);

    if (isset($_POST['return_today']))
    {
        $y = $local_year;
        $m = $local_month;
        $hidden = $local_day;
    }
?>
<div class="calendar"> <!-- 日历主体 -->
    <div class="left_part"> <!-- 左部 -->
        <div class="calendar_top"> <!-- 左边部分的上部 -->
            <form action="" method="post" id="form">
            <input type="submit" name="sub_y" value="<" class="sub">
                <select id="select_y" name="select_y" class="select_y" onchange="ChangeValue()">
                    <?php
                    for ($i=$min_year; $i<=$max_year; $i++)
                    {
                        if ($i == $y)
                            echo "<option value='$i' selected='selected'>$i 年</option>";
                        else
                            echo "<option value='$i'>$i 年</option>";
                    }
                    ?>
                </select>
            <input type="submit" name="add_y" value=">" class="add mgr11">

            <input type="submit" name="sub_m" id="sub_m" value="<" class="sub">
                <select name="select_m" class="select_m" onchange="ChangeValue()">
                    <?php
                    for ($i=1; $i<=12; $i++)
                    {
                        if ($i == $m)
                            echo "<option value='$i' selected='selected'>$i 月</option>";
                        else
                            echo "<option value='$i'>$i 月</option>";
                    }
                    ?>
                </select>
            <input type="submit" name="add_m" id="add_m" value=">" class="add mgr13">

            <input type="submit" name="return_today" value="返回今天" class="return_today">

            <!-- hidden用来存储用户点击选中的日期 -->
            <input type="hidden" name="hidden" id="hidden">
            </form>
        </div>
        <div class="calendar_table"> <!-- 左边部分的下部 -->
            <table cellspacing="0" cellpadding="0">
                <tr class="first">
                    <td><span>一</span></td>
                    <td><span>二</span></td>
                    <td><span>三</span></td>
                    <td><span>四</span></td>
                    <td><span>五</span></td>
                    <td><span class="red">六</span></td>
                    <td><span class="red">日</span></td>
                </tr>
                <?php
                // 算出该月的1号在星期几
                $dayOfweek = date("w", mktime(0,0,0,$m,1,$y));

                // 该月有多少天
                $hm_days = date("t",mktime(0,0,0,$m,1,$y));
                // 算出该月前面和后面 空出(不在该月范围内的) 的日期
                $front_day = !$dayOfweek? 6: $dayOfweek-1; // 在上个月的天数
                $rear_day = 42 - $hm_days - $front_day; // 在下个月的天数



                for ($i=0,$day=1; $i<6; $i++)
                {
                    echo "<tr>";
                    if (0==$i && $front_day)
                    {
                        // 算出上个月有多少天
                        if (1 == $m)
                            $hm_days_2 = date("t",mktime(0,0,0,12,1,$y-1));
                        else
                            $hm_days_2 = date("t",mktime(0,0,0,$m-1,1,$y));
                        // 算出上一个月在这个月中的第一个位置的起始日期
                        $hm_days_2 = $hm_days_2-$front_day+1;

                        for ($k=0; $k<$front_day; $k++)
                            echo "<td class='notCurrentMonthDay'><a href='' onclick=\"return LastMonth('LMDay$hm_days_2')\" id='LMDay$hm_days_2' >".($hm_days_2++)."</a></td>";
                        // 算出该月第一行有多少个日期
                        $hm_days_3 = 7-$front_day;
                        for ($k=0; $k<$hm_days_3; $k++)
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><a href='' name='a' onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            else
                            {
                                echo "<td><a href='' name='a'";
                                if ($hidden == $day)
                                    echo "class='click'";
                                echo " onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            }
                    }
                    else if (4==$i && $rear_day>7)
                    {
                        // 条件是：当前输出的日期$day是否为当月的天数$hm_days
                        for ($k=0; $day<=$hm_days; $k++)
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><a href='' name='a' onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            else
                            {
                                echo "<td><a href='' name='a'";
                                if ($hidden == $day)
                                    echo "class='click'";
                                echo " onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            }

                        // 算出上一个月在这个月倒数第二行有多少个日期
                        $rear_day_2 = $rear_day-7;
                        for ($k=1; $k<=$rear_day_2; $k++)
                            echo "<td class='notCurrentMonthDay'><a href='' onclick=\"return NextMonth('NMDay$k')\" id='NMDay$k' >".$k."</a></td>";
                    }
                    else if (5==$i)
                    {
                        if ($rear_day>7)
                        {
                            for ($k=$rear_day-6; $k<=$rear_day; $k++)
                                echo "<td class='notCurrentMonthDay'><a href='' onclick=\"return NextMonth('NMDay$k')\" id='NMDay$k' >".$k."</a></td>";
                        }
                        else
                        {
                            // 算出该月最后一行有多少个日期
                            $hm_days_4 = 7 - $rear_day;
                            for ($k=0; $k<$hm_days_4; $k++)
                                if ($day==$local_day && $y==$local_year && $m==$local_month)
                                    echo "<td class='local_day'><a href='' name='a' onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                                else
                                {
                                    echo "<td><a href='' name='a'";
                                    if ($hidden == $day)
                                        echo " class='click' ";
                                    echo " onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                                }

                            for ($k=1; $k<=$rear_day; $k++)
                                echo "<td class='notCurrentMonthDay'><a href='' onclick=\"return NextMonth('NMDay$k')\" id='NMDay$k' >".$k."</a></td>";
                        }
                    }
                    else
                    {
                        for ($j=0; $j<7; $j++)
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><a href='' name='a' onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            else
                            {
                                echo "<td><a href='' ";
                                if ($hidden == $day)
                                    echo "class='click'";
                                echo " name='a' onclick=\"return ChoseDay('day$day')\" id='day$day' >".($day++)."</a></td>";
                            }
                    }
                    echo "</tr>";
                }
                ?>
                <!-- js加class后再用php判断进行添加class --><!-- 给a加行相同的className -->
                <!-- <td><a href="" onblur="ClearClass('a1')" onclick="return ChoseDay('a1')" id="a1">1</a></td> -->
             </table>
        </div>
    </div>
    <div class="right_part"> <!-- 右部 -->
        <p class="date">
            <?php
            // 初始化默认选中的日期
            $ch_day = $hidden<10? "0".($hidden+0) : $hidden;

            echo $y."-".($m<10?"0".($m+0):$m)."-<span id='r_day'>".$ch_day."</span> ";

            $ch_week = date("w", mktime(0,0,0,$m,$ch_day,$y));
            switch($ch_week)
            {
                case 0: echo " 星期日"; break;
                case 1: echo " 星期一"; break;
                case 2: echo " 星期二"; break;
                case 3: echo " 星期三"; break;
                case 4: echo " 星期四"; break;
                case 5: echo " 星期五"; break;
                case 6: echo " 星期六"; break;
            }

            ?>
        </p>
        <p id="day_big" class="day"><?php echo $ch_day+0 ?></p>
    </div>
</div>
<script type="text/javascript">
    function ChangeValue(){
        document.getElementById("form").submit();
    }
    function ChoseDay(id){
        var a = document.getElementById(id);
        a.className = "click";
        var day = a.textContent; // 获取选中的日期
        ClearClass(day); // 清除上一个点击的样式
        document.getElementById("day_big").textContent = day;
        document.getElementById("r_day").textContent = day<10? "0"+day : day;
        return false;
    }
    function ClearClass(text){
        var a = document.getElementsByName("a");

        for (i=0; i<a.length; i++)
        {
            if (a[i].textContent!=text)
            {
                if (a[i].className != "")
                    a[i].className = "";
            }
        }
    }
    // 如果选中的是上一个月或下一个月的日期，通过点击日期判断，自动提交月份加减按钮的点击事件
    function LastMonth(id){
        document.getElementById("hidden").value = document.getElementById(id).textContent;
        document.getElementById('sub_m').click();
        return false;
    }
    function NextMonth(id){
        document.getElementById("hidden").value = document.getElementById(id).textContent;
        document.getElementById('add_m').click();
        return false;
    }
</script>
</body>
</html>