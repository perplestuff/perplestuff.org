
var tips = 0;
function tip() {
    tips++;
    document.getElementById("vt").innerHTML = tips;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    
    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);
    
    document.getElementById("time").innerHTML = h+":"+m+":"+s;
}
var t = setInterval('startTime()', 1000);
    
function checkTime(i) {
    if (i<10) {
        i = "0" + i;
    }
    return i;
}