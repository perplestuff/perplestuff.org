<script>
  $('#option').submit (function () {
    var data = options.value;
    $.ajax ({
      type: 'POST',
      url: 'options.php',
      data: {'?options='+data},
      dataType: 'json',
      success: function (data) {
        //ect
      }
    });
  });
</script>

<div id="options">
  <p><b>[OPTIONS]</b></p>
  <form id="option">
    <input type="text" name="options" id="options" maxlength="75"/><br/>
    <input type="submit" name="submit" value="Submit"/>
  </form>
  <!-- <p style="display: hidden;">Command sent.</p> -->
</div>

<?php

if (isset ($_GET ['options'])) {
  $options = explode (' ', $_GET ['options']);
  switch ($options [0]) {
    case '>restore':
      // warning ('this will be used for restoring user accounts');
      $userInfo = $conf ['database'] ->select (
        '*',
        'users',
        'cookie',
        $options [1]
      );
      foreach ($userInfo as $info) {
        user::session ($info);
      }
      break;
    case '>insertcookie':
      if ($_SESSION ['rank'] == 'Admin') {
        $userInfo = $conf ['database'] ->update (
          'users',
          'cookie',
          $options [2],
          'name',
          $options [1]
        );
      } else {
        warning ('You do not have permission to use this command.');
      }
      break;
    case '>help':
      warning ('>restore [code]: Restores account if password is lost.');
      break;
    case '>roll':
      header ("Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ");
      break;

    default:
      warning ('There was a command error, please review syntax and try again.');
      break;
  }
}

?>
