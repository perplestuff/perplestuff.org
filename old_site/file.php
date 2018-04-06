<?php

    $upload = 1;
    $dir = 'uploads/';
    $maxFileSize = 1000000;

    $allowedFile = array (
        'jpg',
        'jpeg',
        'png',
        'gif'
    );

    $userName = $_COOKIE ['User'];
    
    if ($_FILES !== '') {
	$file = $_FILES ['file'];
	$fileN = $file ['name'];
	$fileTN = $file ['tmp_name'];
	$fileS = $file ['size'];
	$fileE = $file ['error'];
	$fileT = $file ['type'];

	$fileN = str_replace("&", "&amp;", $fileN);
	$fileN = str_replace("<", "&lt;", $fileN);
	$fileN = str_replace(">", "&gt;", $fileN);
	$fileN = preg_replace('/\s+/', '', $fileN);

	$ext = explode ('.', $fileN);
	$fileEXT = strtolower (end ($ext));
	$fileNN = uniqid ('', true).".".$fileN;

	if (file_exists($fileS) && $file_exists($fileT)) {
	  echo "<script>
	  alert ('The file already exists.');
	  </script>";
	  $upload = 0;
	}
	if ($fileS > $maxFileSize) {
	  echo "<script>
	  alert ('The filesize is too big, please reduce it and try again.');
	  </script>";
	  $upload = 0;
	}
	if ($fileE === 1) {
	  echo "<script>
	  alert ('Error while uploading file, please report this to @perplestuff on twitter, thanks.');
	  </script>";
	  $upload = 0;
	}
	if (in_array ($fileEXT, $allowedFile)) {
	    /*is all gud*/
	} else {
	  echo "<script>
	  alert ('The current file type: " . $fileEXT . ", is not allowed.');
	  </script>";
	  $upload = 0;
    }

    if ($upload !== 0 && $upload !== 1) {
        echo "<script>
        alert ('Critical error found, please report this to @perplestuff on twitter, thanks.');
        </script>";
        die();
    }
        if ($upload === 1) {
			move_uploaded_file ($fileTN, $dir.$fileNN);
			$data = file_get_contents ("file.txt");
			$content = $userName . ": <br><img src=" . $dir . $fileNN . "><br>" . $data;
            file_put_contents ("file.txt", $content);
        } else {
        echo "<script>
        alert ('File not sent, please try again.');
        </script>";
        die();
        }
		header ("Location: fileboard.php");
    }

    ?>