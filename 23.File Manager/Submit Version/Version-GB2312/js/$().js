// ��װ getElementsByClassName
function getClass(classname)
{
    // ��������֧��
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
// ��װ$(), ��ȡid��class��tag���磺$("#demo")��$(".one")��$("div")
function $(str)
{
    var s = str.charAt(0); // ��ŷ���
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