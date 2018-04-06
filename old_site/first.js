
//CLOCK
function startTime() {
    var today = new Date(),
        h = today.getHours(),
        m = today.getMinutes(),
        s = today.getSeconds();

    m = checkTime(m);
    s = checkTime(s);

    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout ('startTime()', 1000);
}
function checkTime(i) {
    if (i<10) {
        i="0"+i;
    }
    return i;
}

//NULL
/*function nullified() {
    var i = 0;
    setInterval(function(){
        i++;
        var period=new Array(i).join(".");
        document.getElementById('nullified').innerHTML = period;
        if (i>2) {
            i = 0;

        }
    }, 1000);
}*/
function test() {
    var i = 0;
    setInterval(function() {
        var arr = ['</br>','.','..','...'];
        var ecllips = arr[i];
        document.getElementById('nullified').innerHTML = ecllips;
        i++;
        if (i>3) {
            i = 0;
        }
    }, 700);
}
