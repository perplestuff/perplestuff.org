/*major help from: Chris at linuxuser.at*/


//random number
var rand = math.floor((math.random()*5)+1);

//some stupid test

alert ("this script works");

function test() {
    var a = "ha",
        b = "ha";

        alert(a + b);
}

//controls radio
var pth = [
  "images\\Death_Grips_Beware.wav",
  "images\\Death Grips-On GP.mp3",
  "images\\Million Dollar Extreme Presents World Peace Episode 4 Intro Theme - composed by Brian Ellis.mp3",
  "images\\Million Dollar Extreme Presents World Peace - Terminated (Full Version) - Brian Ellis(1).mp3",
  "images\\Nails - Obscene Humanity (Full Album).mp3"
];

var ply = new Audio("images\\Death_Grips_Beware.mp3");
function startRadio() {
    ply.play();
    var player = document.getElementById('radio').innerHTML =
    "<button onclick='stopRadio()'><b>Pause Music.</b></button>";
}
function stopRadio() {
    ply.pause();
    //ply.currentTime = 0;
    var player = document.getElementById('radio').innerHTML =
    "<button onclick='startRadio()'><b>Play Music.</b></button>";
}

//controls clock
function startClock() {
    var t = new Date(),
        h = t.getHours(),
        m = t.getMinutes(),
        s = t.getSeconds();

    h = checkTime(h);
    m = checkTime(m);
    s = checkTime(s);

    document.getElementById("time").innerHTML = h+":"+m+":"+s;
    setTimeout('startClock()',1000);

    function checkTime(i) {
        if (i < 10) {
            i = "0"+i;
            return i;
        } else {
            return i;
        }
    }
}

//controls messaging filter
var fileName = "messages.txt";
var fileread = FileReader.readAsText (fileName);
alert(fileread);

//shows errors
window.onerror = function (msg, url, linenumber) {
    alert ('Error: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return True;
}