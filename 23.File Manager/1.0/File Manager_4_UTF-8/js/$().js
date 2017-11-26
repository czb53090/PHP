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