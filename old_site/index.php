<!DOCTYPE HTML>
<html lang='en'>
	<head>
		<title>No escape.</title>
        <link rel="icon" href="images/realeyesteeth.png">
		<meta charset="utf-8">
		<script src="javascript.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body onload="startClock()">
		<div id="body">
		<h1 class="title">[main page]<h1>
		<b>Radio:</b>
		<div id='radio'>
		<button onclick='startRadio()'><b>Play Music.</b></button></div>
		<!--<audio controls preload="metadata" id="radio">
			<source src="images/Death_Grips_Beware.mp3"/>
			<source src="images/Death_Grips_Beware.wav"/>

		</audio>--><br>
		<!--<input type="button" onclick="player.play()" value="Play"/>
		<input type="button" onclick="player.pause()" value="Pause"/><br>-->

		<img src="images/hyperdistort.jpg" class="pics"/>
		<img src="images/hyperdistort1.jpg" class="pics"/>
		<img src="images/hyperdistort2.jpg" class="pics"/>

		<div id="time">00:00:00</div><br>
		<p><b>Welcome to the main page.</b> Here you can navigate to different pages and the bottom
		is where you can put your info so i<br> know whos using it. If the website for some reason
		refuses to load, changes, or breaks, that just means im editing something. This<br>
		should always be up 24/7. <small>ps. the radio only has one song at the moment xd.</small></p><br>

            <!--<iframe id="vid" src="https://vid.me/e/k1BxV?loop=1&stats=0" width="1920" height="1080" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen scrolling="no"></iframe><br>-->
		
		<h1>[Set username]</h1>
        <form action="setChatCookie.php" method="post">
        <p>Name: <input type="text" name="name" size="30" maxlength="15"/></p>
        <input type="submit" name="submit" value="Set User Name">
        </form>

        <p>Please enter your username.<b>Note that your login only last 24 hours</b>.</p><br>
		<p>The maximum allowed charactors in the <b>name field</b> are <b>15</b>.</p><br>

		<h1>[navigation]</h1>
		<ul><b>
			<li><a  href="messageboard.php">Message Board</a></li>
      		<li><a href="fileboard.php">File Board</a></li>
			<li><a href="experimental/second.html">Experimental Index</a></li>
			<li><a href="first.php">Original Index</a></li>
			<li><a href="Fortune.html">Fortune Finder</a></li>
			<li>comming soon</li>
			<li>comming soon</li>
		</b></ul>
		<p>Current location: <a href="http://watch.everythingisterrible.com/">null.</a></p>
        <div id="left">
            <b>[please provide info]</b>
            <form action="form_test.php" method="POST">

            <p>Name: <input type="text" name="name" size="30"/></p>

            <p>Rate: <select name="rate">
            <option value="Shit">this website is shit.</option>
            <option value="Okay">this website is okay.</option>
            <option value="Nice">this website is very nice.</option>
            </select></p>

            <p>Recommend:
            <input type="radio" name="recommend" value="Yes"/>Yes.
			<input type="radio" name="recommend" value="Maybe"/>Maybe. <small>If more is added.</small>
            <input type="radio" name="recommend" value="No"/>No.</p>

			<p>Suggestion:
			<input type="text" name="suggestion" size="50" maxlength="100"/><br>
			<small>Max length for suggestions are <b>100</b> characters.</small></p>

            <input type="submit" name="submit" value="Enter."/>
			</form>
		</div>
        <div id="right">
            <img src="images/rocky.PNG" class="pics">
            <h1>Rocky</h1>
            <b>2007-2017</b>
        </div>
	</body>
</html>
