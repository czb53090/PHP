// 封装的getElementsByClassName
function getClass(classname)
{
    // 如果浏览器支持
    if (document.getElementsByClassName)
        return document.getElementsByClassName(classname);

    var arr = [];
    var dom = document.getElementsByTagName("*");
    for (var i=0,len_dom=dom.length; i<len_dom; i++)
    {
        var classArr = dom[i].className.split(" ");
        for (var j=0,len_classArr=classArr.length; j<len_classArr; j++)
            if (classArr[j] == classname);
        arr.push(dom[i]);
    }
    return arr;
}
// 封装$(), 如$("#demo")、$(".one")、$("div")
function $(str)
{
    var s = str.charAt(0); // 存放符号
    var ss = str.substr(1);
    switch (s)
    {
        case "#":
            return document.getElementById(ss);
            break;
        case ".":
            return getClass(ss);
            break;
        default:
            return document.getElementsByTagName(str);
            break;
    }
}
// 可视区域大小
function client() {
    if (window.innerWidth != null)
        return {
            width: window.innerWidth,
            height: window.innerHeight
        };
    else if (document.compatMode == "CSS1Compat")
        return {
            width: document.documentElement.clientWidth,
            height: document.documentElement.clientHeight
        };
    return {
        width: document.body.clientWidth,
        height: document.body.clientHeight
    }

}
window.onload = function() {
    // 获取各个文件夹对象
    var folders = $(".folder");
    // alert(folders.length);

    // 获取各个文件夹的父级li对象
    var folder_lis = $(".folder-li");
    //    alert(folder_lis.length);
    var folder_lis_len = folder_lis.length;


    // 三个小圆点和下弹菜单相关变量
    var operations = new Array();
    var operation_boxs = $(".operation-box");
    var dotss = new Array();

    // 三个操作按钮相关变量
    var rename_box = $("#rename-box");
    var text_rn = $("#text-rn");
    var hidden_rn = $("#hidden-rn");
    var opss = new Array();

    // 三个小圆点极其相应操作的效果响应：
    for (var i = 0; i != folder_lis_len; i++)
    {
        var folder = folder_lis[i];
        operations[i] = operation_boxs[i].getElementsByTagName("div")[1].children;
        // alert(operations[i].length); // 3

        folder.index = i;
        dotss[i] = operations[i][0].parentNode.parentNode.children[0];
        folder.onmouseover = function() {
            // alert("onmousemove");
            this.className = "folder-li folder-choose";
            dotss[this.index].style.display = "block";
            // console.log(operations[this.index][0].parentNode.parentNode.children[0].innerHTML);
            // console.log(123);
        }
        folder.onmouseout = function() {
            this.className = "folder-li";
            dotss[this.index].style.display = "none";
        }

        // console.log(folder_lis[i].getElementsByClassName("operations")[0].children[0].children[0].innerHTML);
        // console.log(operations[i][0].innerHTML);
        // console.log(operations[i].length); // 3

        var as = operations[i];
        // alert(as.length); // 3
        opss[i] = as[0].parentNode.parentNode.children[1];
        dotss[i].index = i;

        dotss[i].onclick = function() {
            opss[this.index].style.display = "block";
        }
        dotss[i].onmouseout = function() {
            opss[this.index].style.display = "none";
        }
        dotss[i].parentNode.children[1].onmouseover = function() {
            this.style.display = "block";
            this.onmouseout = function() {
                this.style.display = "none";
            }
        }

        var rename = as[1];
        rename.index = i + 1;

        rename.onclick = function() {
            // alert("重命名被点中");
            // 设置 rename-box 盒子的位置，并将当前文件夹名填入隐藏域中
            rename_box.style.display = "block";
            rename_box.style.top = this.index * rename_box.previousElementSibling.offsetHeight - this.index + 1 + "px";
            // alert(folders[this.index].innerHTML);
            text_rn.value = folders[this.index-1].innerHTML;
            // alert(this.index); // OK
            // alert(rename_box.previousElementSibling.offsetHeight); // 30

            text_rn.focus();
            text_rn.select();

            hidden_rn.value += "&old_name=" + folders[this.index-1].innerHTML + "";
            // alert(hidden_rn.value);
        }
        $("#submit-rn-yes").onclick = function() {
            hidden_rn.value += "&new_name=" + text_rn.value;
            // alert(hidden_rn.value);
            window.location.href = hidden_rn.value;
        }

        $("#submit-rn-cancel").onclick = function() {
            // window.location.href = "Folder Manager_2.php";
            rename_box.style.display = "none";
        }

        var remove = as[0];
        remove.index = i + 1;
        // alert(remove.index);
    }


    // "移动到" 窗口相关变量
    var drag_rv = $("#drag-rv");
    var close_rv = drag_rv.getElementsByTagName("span")[1];
    var btn_yes_rv = $("#btn-yes-rv");
    var btn_cancel_rv = $("#btn-cancel-rv");

    // 实现拖拽 "移动到" 窗口
    drag_rv.onmousedown = function(event) {
        var event = event || window.event;
        var that = this.offsetParent;
        var tshifting = parseInt(that.offsetHeight/2);
        var lshifting = parseInt(that.offsetWidth/2);
        var topValue = event.clientY - that.offsetTop - tshifting;
        var leftValue = event.clientX - that.offsetLeft - lshifting;
        document.onmousemove = function(event) {
            var event = event || window.event;
            that.style.top = event.clientY - topValue + "px";
            that.style.left = event.clientX - leftValue + "px";

            // console.log(that.offsetTop);
            // console.log(client().height + "  " + that.offsetHeight);
            var topMax = client().height - that.offsetHeight;
            if (that.offsetTop > topMax)
                that.style.top = topMax + tshifting - 1 + "px";
            else if (that.offsetTop < 0)
                that.style.top = tshifting + "px";

            var leftMax = client().width - that.offsetWidth;
            if (that.offsetLeft > leftMax)
                that.style.left = leftMax + lshifting - 1 + "px";
            else if (that.offsetLeft < 0)
                that.style.left = lshifting + "px";

            window.getSelection ? window.getSelection().removeAllRanges() :
                document.selection.empty();
        }
        document.onmouseup = function() {
            document.onmousemove = null;
        }
    }
    // 关闭 移动目录 窗口
    // console.log(close_rv.innerHTML);
    close_rv.onclick = btn_cancel_rv.onclick = function() {
        drag_rv.parentNode.style.display = "none";
    }
}