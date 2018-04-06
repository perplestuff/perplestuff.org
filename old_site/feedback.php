<?php
include "pages/constants/header.php";
header ("Refresh:5; URL=http://perplestuff.org");

$name = htmlspecialchars ($_REQUEST ['name']);
$rate = htmlspecialchars ($_REQUEST ['rate']);
$use = htmlspecialchars ($_REQUEST ['use']);
$data = $name . "<br/>" . $rate . "<br/>" . $use . "<br/><br/>";
$file = 'pages/storage/feedback.html';

file_put_contents ($file, $data, PHP_EOL . FILE_APPEND);

echo "Thanks for the input, you will be directed back to Home Page.";
echo "<p>Name: $name<br/>Rate: $rate<br/>Use: $use<br/>";
echo "Redirect back to index in 5 seconds.";

include "pages/constants/footer.php";
?>
<html>
<div class="feedback">
  <header>[Feedback]</header>
  <form action="feedback" method="POST">
    <p>Name:</p>
    <input type="text" name="name" value="Anonymous"/>
    <p>Rate:</p>
    <select name="rate">
      <option value="Neutral.">Neutral.</option>
      <option value="Pretty good, needs work.">Pretty good, needs work.</option>
      <option value="Not good, needs alot of work.">Not good, needs alot of work.</option>
      <option value="Awesome.">Awesome.</option>
      <option value="Bad.">Bad.</option>
    </select><br/>
    <p>Would you use this as your<br/> daily social media site?</p>
    <input type="radio" name="use" value="Yes.">Yes.
    <input type="radio" name="use" value="No.">No.<br/>
    <input type="submit" name="submit" value="Submit."/>
  </form>
</div>
</html>
