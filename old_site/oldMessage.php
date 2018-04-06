<html>
	<head>
		<title>Messages</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div id="body"></div>
		<?php 
		$name = $_POST['name'];
		$message = $_POST['message'];
		$date = date("h:i:sa");
		$data = $date . " " . $name . ": " . $message . "</br>";
		$file = "messages.txt";
        
        $nameLimit = substr($name,15);
        $msgLimit = substr($message,100);
        
        if (!$nameLimit && !$msgLimit) {
            file_put_contents($file, $data . PHP_EOL, FILE_APPEND);
            print "<p>Thank you $name for posting. Your message has sent.</p>";
            header("Refresh:2; url=messages.php");
        } else {
            echo "<b style='color:red;'>Charactor limit exceeded, please shorten it and try again.</b>";
            header("Refresh:5; url=messageboard.php");
        }
		
		//file_put_contents($file, $data . PHP_EOL, FILE_APPEND);
		
		?>
		</div>
	</body>
</html>
