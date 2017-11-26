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
            font: 400 12px/20px "SimSun";
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
        .left_part .calendar_table tr.first{
            background-color: #F5F9FF;
        }
        .left_part .calendar_table tr.first td {
            border-top: 1px solid #5CAEFF;
            height: 33px;
            font-size: 16px;
            line-height: 34px;
            font-weight: normal;
        }
        .left_part .calendar_table td {
            width: 54px;
            height: 54px;
            font-weight: bold;
            float: left;
            margin-left: -1px;
        }
        .left_part .calendar_table .row5 td {
            padding: 6px 0;
        }
        .left_part .calendar_table .row5 tr.first td {
            padding: 0;
        }
        .left_part .calendar_table .row5 tr.second td {
            padding: 0 0 6px 0;
        }
        .left_part .calendar_table .row5 tr.last td {
            padding: 7px 0;
        }
        .red
        {
            color: #E02D2D;
        }
        .left_part .calendar_table td span {
            display: block;
            width: 52px;
            height: 54px;
            line-height: 53px;
            font-size: 18px;
            border: 1px solid #fff;
            border-top: 1px solid #ddd;
            position: relative;
            cursor: pointer;
        }
        .left_part .calendar_table td:nth-child(6n) span,
        .left_part .calendar_table td:nth-child(7n) span
        {
            color: #E02D2D;
        }
        .left_part .calendar_table td span:hover {
            border: 1px solid #19B955;
            z-index: 3;
        }
        .left_part .calendar_table td span:active {
            border: 1px solid #FD8795;
            color: #159B47;
            z-index: 3;
        }
        .calendar_table td span.click {
            /* 当a被点击时 */
            background-color: #F5FEF9;
            border: 1px solid #19B955;
            color: #159B47;
            z-index: 2;
        }
        .left_part .calendar_table td.local_day span {
            /* 把class加在td防止a的class被js代码改写 */
            /* 该样式可重叠掉上面的.click，因为权重比其高，用于高亮今天的日期 */
            background-color: #FFBB00;
            color: #fff;
            border: 1px solid #FFBB00;
            z-index: 1;
        }
        .left_part .calendar_table td.notCurrentMonthDay span {
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
    // 初始化：获取当前系统时间
    $local_year = date("Y")<2017? 2017 : date("Y");
    $local_month = date("m");
    $local_day = date("d");

    // 给出允许年份的最大、最小值
    $min_year = 1902;
    $max_year = 2037;


    $y = isset($_POST['select_y'])? $_POST['select_y'] : $local_year;
    if (isset($_POST['sub_y'])) // 年份-1
        if ($y > $min_year)
            $y -= 1;
    if (isset($_POST['add_y'])) // 年份+1
        if ($y < $max_year)
            $y += 1;
    $m = isset($_POST['select_m'])? $_POST['select_m'] : $local_month;
    if (isset($_POST['sub_m'])) // 月份-1
        if ($m > 1)
            $m -= 1;
        else
        {
            if ($y != $min_year)
            {
                $m = 12;
                $y -= 1;
            }
        }
    if (isset($_POST['add_m'])) // 月份+1
        if ($m < 12)
            $m += 1;
        else
        {
            if ($y != $max_year)
            {
                $m = 1;
                $y += 1;
            }
        }

    // $hidden 存储的是用户通过点击日期中的灰色字部分
    // (也就是分属上个月和下个月的日期，该日期通过js获取
    // 并填入hidden域且实现 加减月份的按钮 来跳转至相应的月份)；
    // 但默认通过按钮跳转月份、年份将使其置1；当年月与本地时间相同时会存储为本天。
    $hidden = isset($_POST['hidden'])&&$_POST['hidden']!="" ? $_POST['hidden'] : ($y==$local_year&&$m==$local_month ? $local_day : 1);

    if (isset($_POST['return_today'])) // 按下‘返回今天’按钮
    {
        $y = $local_year;
        $m = $local_month;
        $hidden = $local_day;
    }

    // 算出 $m月的1号在星期几
    $dayOfweek = date("w", mktime(0,0,0,$m,1,$y));
    // 该月有多少天
    $hm_days = date("t",mktime(0,0,0,$m,1,$y));
    // 算出 $m月前面和后面(也就是显示在表格中第一行和最后一行中) 空出(不在该月范围内的) 的日期
    $front_day = !$dayOfweek? 6: $dayOfweek-1; // 在上个月的天数
    $rear_day = 42 - $hm_days - $front_day; // 在下个月的天数
?>
<div class="calendar"> <!-- 日历主体 -->
    <div class="left_part"> <!-- 左部 -->
        <div class="calendar_top"> <!-- 左边部分的上部 -->
            <form action="" method="post" id="form">
                <!-- 年份选择 -->
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

                <!-- 月份选择 -->
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

                <!-- 返回今天按钮 -->
                <input type="submit" name="return_today" value="返回今天" class="return_today">

                <!-- hidden用来存储用户点击选中的日期 -->
                <input type="hidden" name="hidden" id="hidden">
            </form>
        </div>
        <div class="calendar_table"> <!-- 左边部分的下部(日历部分) -->
            <!-- 判断 $rear_day 来把日历分为5行或6行，通过class属性与循环同步实现 -->
            <table cellspacing="0" cellpadding="0" <?php if ($rear_day>=7) echo "class='row5'" ?>>
                <tr class="first">
                    <td>一</td>
                    <td>二</td>
                    <td>三</td>
                    <td>四</td>
                    <td>五</td>
                    <td class="red">六</td>
                    <td class="red">日</td>
                </tr>
                <?php
                // 进行日历的输出操作
                for ($i=0,$day=1; $i<6; $i++)
                {
                    if (0==$i)
                    {
                        // 为了保证分为5行时的布局合理(与6行时等高)，需设置td的padding值(通过
                        // 上面的class为.cell5来实现)并将table中第二行td的上padding清除，分为
                        // 六行时则无需设置padding，td之间无缝隙
                        echo "<tr class='second'>";

                        $k=0;
                        if ($front_day) // 当上个月的日期个数不为0时
                        {
                            // 算出上个月有多少天
                            if (1 == $m)
                                $hm_days_L = date("t",mktime(0,0,0,12,1,$y-1));
                            else
                                $hm_days_L = date("t",mktime(0,0,0,$m-1,1,$y));
                            // 再算出表格中第一行第一个位置在上个月的日期
                            $hm_days_L = $hm_days_L-$front_day+1;
                            // 输出第一行上个月的日期
                            for (; $k<$front_day; $k++)
                                // notCurrentMonthDay类用于把字体变为灰色，说明该日期不属于这个月
                                // onclick事件的LastMonth函数用来把点击的日期存入hidden域中并跳转至上个月
                                echo "<td class='notCurrentMonthDay'><span onclick=\"LastMonth('LMDay$hm_days_L')\" id='LMDay$hm_days_L' >".($hm_days_L++)."</span></td>";
                        }
                        // 输出第一行这个月的日期
                        for (; $k<7; $k++)
                            // 如果输出的日期刚好为本地日期，则添加td的class属性为local_day以高亮该日期
                            // onclick事件的ChoseDay函数用来给点击的日期添加
                            // 样式，同时清除上个点击事件带来的样式
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><span name='span' onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            else
                            {
                                echo "<td><span name='span'";
                                if ($hidden == $day) // 默认指定 $hidden日期为选中状态
                                    echo "class='click'";
                                echo " onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            }

                        echo "</tr>";
                    }
                    else if (4==$i && $rear_day>=7)
                    {
                        echo "<tr class='last'>";
                        // 终止条件：当前输出的日期$day是否为当月的所有天数$hm_days
                        $k = 0;
                        while ($day <= $hm_days) // 该循环输出与上面的一样
                        {
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><span name='span' onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            else
                            {
                                echo "<td><span name='span'";
                                if ($hidden == $day)
                                    echo "class='click'";
                                echo " onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            }
                            $k++;
                        }

                        // 算出下个月在这个月最后一行中有多少个日期
                        $rear_day_2 = $rear_day-7;
                        for ($k=1; $k<=$rear_day_2; $k++) // 输出下个月的日期
                            // onclick事件的NextMonth函数用来把点击的日期存入hidden域中并跳转至下个月
                            echo "<td class='notCurrentMonthDay'><span onclick=\"NextMonth('NMDay$k')\" id='NMDay$k' >".$k."</span></td>";

                        echo "</tr>";
                        // 当$rear_day>=7时就没必要输出第六行，退出循环
                        break;
                    }
                    else if (5==$i)
                    {
                        echo "<tr>";
                        $k = 0;
                        while ($day <= $hm_days)
                        {
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><span name='span' onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            else
                            {
                                echo "<td><span name='span'";
                                if ($hidden == $day)
                                    echo " class='click' ";
                                echo " onclick=\"ChoseDay('$k$day')\" id='$k$day' >".($day++)."</span></td>";
                            }
                            $k++;
                        }

                        for ($k=1; $k<=$rear_day; $k++) // 输出下个月的日期
                            echo "<td class='notCurrentMonthDay'><span onclick=\"NextMonth('NMDay$k')\" id='NMDay$k' >".$k."</span></td>";

                        echo "</tr>";
                    }
                    else
                    {
                        echo "<tr>";
                        for ($j=0; $j<7; $j++)
                            if ($day==$local_day && $y==$local_year && $m==$local_month)
                                echo "<td class='local_day'><span name='span' onclick=\"ChoseDay('$j$day')\" id='$j$day' >".($day++)."</span></td>";
                            else
                            {
                                echo "<td><span ";
                                if ($hidden == $day)
                                    echo "class='click'";
                                echo " name='span' onclick=\"ChoseDay('$j$day')\" id='$j$day' >".($day++)."</span></td>";
                            }
                        echo "</tr>";
                    }
                }
                ?>
             </table>
        </div>
    </div>
    <div class="right_part"> <!-- 右部 -->
        <p class="date">
            <?php
            echo $y."-".($m<10?"0".($m+0):$m)."-<span id='r_day'>".($hidden<10?"0".($hidden+0):$hidden)."</span> <span id='r_week'>";
            // 获取星期
            $ch_week = date("w", mktime(0,0,0,$m,$hidden,$y));
            switch($ch_week)
            {
                case 0: echo "星期日"; break;
                case 1: echo "星期一"; break;
                case 2: echo "星期二"; break;
                case 3: echo "星期三"; break;
                case 4: echo "星期四"; break;
                case 5: echo "星期五"; break;
                case 6: echo "星期六"; break;
                default: echo ""; break;
            }
            echo "</span>";
            ?>
        </p>
        <p id="day_big" class="day"><?php echo $hidden+0 ?></p>
    </div>
</div>
<script type="text/javascript">
    function ChangeValue(){ // 当下拉框内容改变时提交表单
        document.getElementById("form").submit();
    }
    function ChoseDay(id){
        var span = document.getElementById(id);
        var day = span.textContent; // 获取当前选中的日期
        ClearClass(); // 清除上一个点击的样式
        span.className = "click"; // 把span的 class 属性改为 click
        document.getElementById("r_day").textContent = day<10? "0"+day : day; //把日期替换到右边的第一行日期中
        document.getElementById("day_big").textContent = day; // 把日期替换到右边的橘色方框内
        var week = document.getElementById("r_week");
        switch(id[0])
        {
            case "0": week.textContent = "星期一"; break;
            case "1": week.textContent = "星期二"; break;
            case "2": week.textContent = "星期三"; break;
            case "3": week.textContent = "星期四"; break;
            case "4": week.textContent = "星期五"; break;
            case "5": week.textContent = "星期六"; break;
            case "6": week.textContent = "星期日"; break;
            default:  week.textContent = ""; break;
        }
    }
    function ClearClass(){
        var spans = document.getElementsByName("span");
        for (var i=0,len_spans=spans.length; i<len_spans; i++)
        {
            var classArr = spans[i].className.split(" ");
            for (var j=0,len_classArr=classArr.length; j<len_classArr; j++)
                if (classArr[j] == "click")
                    classArr[j] = "";
            spans[i].className = classArr.join(" ");
        }
    }

    // LastMonth和NextMonth函数：如果选中的是上一个月或下一个月
    // 的日期，将日期填入hidden域，自动提交月份通过月份加/减按钮的表单
    function LastMonth(id){
        document.getElementById("hidden").value = document.getElementById(id).textContent;
        document.getElementById('sub_m').click();
    }
    function NextMonth(id){
        document.getElementById("hidden").value = document.getElementById(id).textContent;
        document.getElementById('add_m').click();
    }
</script>
</body>
</html>