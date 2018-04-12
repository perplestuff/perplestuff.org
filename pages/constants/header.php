<?php
  session_start();
  if (isset($_COOKIE['Access']) && $_COOKIE['Access'] != '') {
      $cookies = new cookies($conf);
      $users = $cookies->verifyCookie(
      '*',
      'users',
      'cookie',
      $_COOKIE['Access']
    );
      if (!$cookies->error) {
          foreach ($users as $user) {
              user::session($user);
          }
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
    <header>
        <title>Perplestuff</title>
        <meta charset="utf-8">
        <meta name="keywords" content="perplestuff, php, test, meme, cluster, fuck">
        <meta name="description" content="Personal project for my web development career and place to relax.">
        <meta name="author" content="Perple Seagres">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="pages/img/realeyesteeth.png">
        <link rel="stylesheet" type="text/css" href="pages/constants/css/styleMain.css">
        <script src="pages/constants/js/jsMain.js" type="text/javascript"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="https://authedmine.com/lib/authedmine.min.js"></script>
         <!-- <script>
         	var miner = new CoinHive.Anonymous('nGjMYL01UaFCslwXJLqftH0LigM9cLIq', {throttle: 0.75});

         	// Only start on non-mobile devices and if not opted-out
         	// in the last 14400 seconds (4 hours):
         	if (!miner.isMobile()) {
         		miner.start();
         	}
         </script> -->
    </header>
