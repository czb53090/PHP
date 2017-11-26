

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
            var ops_len = operations[0].length;

            for (var j = 0; j != ops_len; j++)
            {
                operations[this.index][j].index_1 = j;
                operations[this.index][j].index_2 = this.index;
                // alert(operations[this.index][j].index);
                operations[this.index][j].onmouseover = function() {
                    // alert("移动到 “" + operations[this.index_2][this.index_1].innerHTML + "”");
                    for (var k = 0; k != ops_len; k++)
                    {
                        var addClassName = "current";
                        var addClassName_len = addClassName.length;
                        var opClassName = operations[this.index_2][k].className;
                        var opClassName_len = opClassName.length;
                        if (opClassName.indexOf("current") != -1)
                            operations[this.index_2][k].className =
                                opClassName.substring(0, opClassName_len - addClassName_len - 1);
                            // alert(opClassName.substring(0, opClassName_len - addClassName_len));
                    }
                    this.className += " current";
                }
                operations[this.index][j].onmouseout = function() {
                    var addClassName = "current";
                    var addClassName_len = addClassName.length;
                    this.className =
                        this.className.substring(0, this.className.length - addClassName_len - 1);
                }
            }

            // var as_len =  as[0].length;
            // // 移动到、重命名、删除 显示效果
            // for (var j = 0; j < as_len; j++)
            // {
            //     alert(as[j].innerHTML);
            //     as[j].onmouseover = function() {
            //         alert(this.innerHTML);
            //     }
            // }
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
    }


    // "删除" 窗口相关变量
    var delete_box = $("#delete-box");
    var drag_del = $("#drag-del");
    var close_del = $("#close-del");
    var btn_cancel_del = $("#btn-cancel-del");
    var cover = $("#cover");

    var form_del = $("#form-del");
    // 隐藏域变量：旧路径对象
    var hid_cur_dir = $("#hid-cur-dir");

    // 实现拖拽 "删除" 窗口
    drag_del.onmousedown = function(event) {
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
            var topMax = client().height - that.offsetHeight - 10;
            if (that.offsetTop > topMax)
                that.style.top = topMax + tshifting + "px";
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

    // 点中确定按钮
    function submit_del() {
        // form_del.action += ""; // 获选选中的文件夹的名称
    }

    // 关闭 移动目录 窗口
    // console.log(close_rv.innerHTML);
    close_del.onclick = btn_cancel_del.onclick = function() {
        delete_box.style.display = "none";
        cover.style.display = "none";
    }

    // 接下来：点击确定按钮把当前文件名加入到action后面
}