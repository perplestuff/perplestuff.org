<?php

class coin {
  private $conf;
  public $error;

  function __construct ($conf) {
    $this ->conf = $conf;
    $this ->error = 1;
  }

  public function captcha ($post, $hash) {
    $post_data = [
    	'secret' => $this ->conf ['coin'] ['Skey'], // <- Your secret key
    	'token' => $post,
    	'hashes' => $hash
    ];

    $post_context = stream_context_create([
    	'http' => [
    		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    		'method'  => 'POST',
    		'content' => http_build_query($post_data)
    	]
    ]);

    $url = 'https://api.coinhive.com/token/verify';
    $response = json_decode(file_get_contents($url, false, $post_context));

    if ($response && $response ->success) {
      $this ->error = 0;
    }
  }
}

 ?>
