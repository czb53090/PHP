function show_bomb(error_text) {
    $("#point-out").innerHTML = error_text;
    $("#bomb-box").style.display = "block";
    $("#cover").style.display = "block";
}