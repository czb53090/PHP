<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title>Document</title>
    <style type="text/css">
        table{
            margin: 0 auto;
            width: 700px;
            border: 1px solid #ccc;
        }
        tr{
            height: 50px;
        }
        tr.first{
            background-color: dodgerblue;
            height: 30px;
        }
        tr.first td h2{
            color: #ffa;
        }
        tr.first h2{
            font-size: 20px;
            line-height: 30px;
        }
        tr:nth-child(2n){
            background-color: #afa;
        }
        td:nth-child(1){
            width: 150px;
            text-align: center;
        }
        .h100{
            height: 100px;
        }
        tr.last{
            background-color: skyblue;
        }
        .submit1{
            width: 80px;
            height: 25px;
            font-size: 12px;
        }
        .submit2{
            width: 50px;
            height: 25px;
            font-size: 12px;
        }
    </style>
</head>
<body>
<form action="17.result.php" method="post">
    <table cellspacing="0">
        <tr class="first">
            <td colspan="2" ><h2>在线考试程序</h2></td>
        </tr>
        <tr>
            <td>单选题1</td>
            <td>下列属于宋代诗人的是：(5分)</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="radio" name="radio1" id="radio1_1"><label for="radio1_1">岑参</label>
                <input type="radio" name="radio1" id="radio1_2"><label for="radio1_2">高适</label>
                <input type="radio" name="radio1" id="radio1_3"><label for="radio1_3">杨万里</label>
                <input type="radio" name="radio1" id="radio1_4"><label for="radio1_4">宋之问</label>
            </td>
        </tr>
        <tr>
            <td>单选题2</td>
            <td>下列不属于苏东坡的作品是：(5分)</td>
        </tr>
        <tr class="h100">
            <td></td>
            <td>
                <p><input type="radio" name="radio2" id="radio2_1"><label for="radio2_1">念奴娇·赤壁怀古</label></p>
                <p><input type="radio" name="radio2" id="radio2_2"><label for="radio2_2">水调歌头·千里共婵娟</label></p>
                <p><input type="radio" name="radio2" id="radio2_3"><label for="radio2_3">江城子·十年生死两茫茫</label></p>
                <p><input type="radio" name="radio2" id="radio2_4"><label for="radio2_4">踏莎行·郴州旅社</label></p>

            </td>
        </tr>
        <tr>
            <td>多选题1</td>
            <td>下列属于唐宋八大家的作者是：(10分)</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="checkbox" name="check1[]" id="check1_1"><label for="check1_1">杜甫</label>
                <input type="checkbox" name="check1[]" id="check1_2"><label for="check1_2">曾孔</label>
                <input type="checkbox" name="check1[]" id="check1_3"><label for="check1_3">王勃</label>
                <input type="checkbox" name="check1[]" id="check1_4"><label for="check1_4">苏洵</label>
            </td>
        </tr>
        <tr>
            <td>多选题2</td>
            <td>请选出属于七绝的作品(10分)</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="checkbox" name="check2[]" id="check2_1"><label for="check2_1">滁州西涧</label>
                <input type="checkbox" name="check2[]" id="check2_2"><label for="check2_2">登鹳雀楼</label>
                <input type="checkbox" name="check2[]" id="check2_3"><label for="check2_3">钱塘湖春行</label>
                <input type="checkbox" name="check2[]" id="check2_4"><label for="check2_4">登科后</label>
            </td>
        </tr>
        <tr>
            <td>填空题</td>
            <td>请补充完整下面的诗词：(10分)</td>
        </tr>
        <tr>
            <td></td>
            <td>逐舞飘清袖，传歌共绕梁。<input type="text" name="Completion1" maxlength="5" size="10" />，吹花松远乡</td>
        </tr>
        <tr class="last">
            <td colspan="2" >
                <input type="submit" name="savebt" value="保存答案" class="submit1">
                <input type="submit" name="submit" value="交卷" class="submit2">
            </td>
        </tr>
    </table>
</form>
</body>
</html>