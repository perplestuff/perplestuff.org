
<html>
	<head>
		<title>Messages</title>
		<!--<meta http-equiv="refresh" content="10">-->
		<link rel="stylesheet" type="text/css" href="style.css"/>
        <script src="jquery.js" type="text/javascript"></script>

        <script type="text/javascript">

        function submit_msg() {
            var message = message.value;
            var xmlHttp = new XMLHttpRequest();


            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var chats = document.getElementById("chat").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open('GET','message.php?message='+message, true);
            xmlhttp.send();
        }
        $(document).ready(function(e){
            $.ajaxSetup({cache:false});
            setInterval(function(){
                $('#chat').load('messages.txt');
            },1000);
        });

        </script>
	</head>
	<div id="body">
	<h1 class="title">[Messages]</h1>
	<p>The dates shown are local server time.</p>
	<p>Assume posts are anonymous even with alias, impersonations possible.</p>
	</div>
	<body>
		<!--

		function updateChat() {
			$msg = file_get_contents('messages.txt');
			print "
			<p1>$msg</p1>"
		}-->

        <div id="chat"><p>Loading...</p></div>

		<!--<form action="messages.php" method="POST" enctype="multipart/form-data">-->
        <form/>
        <p>Message: <input type="text" name="message" size="100" autofocus /></p>
        <button onclick="submit_msg()">Send Message</button><br>

        <!--<input type="file" name="file" id="file">
        <input type="submit" value="submit" name="submit"></p>
        </form><br>

        Update interval: <input type="range" name="update" min="1" max="10">-->

		<p>This should update by itself, if not please contact @perplestuff on twitter. Thanks.</p>
		<a link href="messageboard.php">Go back to messageboard.</a><br>
    </body>
</html>
<?php include ("message.php"); ?>