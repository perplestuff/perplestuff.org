// CLOCK

function clock ()
{
    var date = new Date(),
        h = date.getHours(),
        m = date.getMinutes(),
        s = date.getSeconds();

    function check(i)
    {
        if (i < 10) {
            i = "0" + i;
            return i;
        } else {
            return i;
        }
    }

    h = check(h);
    m = check(m);
    s = check(s);

    document.getElementById("time").innerHTML = h + ":" + m + ":" + s;

    setTimeout("clock()", 1000);
}

function startMsg()
{
    
}
