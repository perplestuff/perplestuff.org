<?php require 'core/bootstrap.php' ?>

<form action="messageInput.php" method="POST">
	<input type="text" name="msg" id="msg"/>
	<input type="file" name="file" id="file"/>
	<input type="submit" name="submit" value="Submit."/>
</form>

<?php
warning($_POST['msg']);


 ?>
