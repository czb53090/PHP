
window.onload  = function()
{
    // "�ƶ���" ������ر���
    var drag_mv = $("#drag-mv");
    var close_mv = $("#close-mv");
    var btn_cancel_mv = $("#btn-cancel-mv");

    // �������������·������
    var hid_old_dir = $("#hid-old-dir");

    // ʵ����ק "�ƶ���" ����
    drag_mv.onmousedown = function(event) {
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

    // �ر� �ƶ�Ŀ¼ ����
    // console.log(close_rv.innerHTML);
    close_mv.onclick = btn_cancel_mv.onclick = function() {
        window.location.href = "index.php?d=" + hid_old_dir.value;
    }
}