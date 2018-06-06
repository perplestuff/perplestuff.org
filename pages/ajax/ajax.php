<?php
$count = $conf['database']->count('msg');
$msgCount = $count - 50;
$get = $conf['database']->between('*', 'msg', 'id', $msgCount, $count);
?>
<?php foreach($get as $a) : ?>
	<div id="chat">
		<small>#<?= $a->id; ?> ~</small>
		<span style="color:<?= $a->options; ?>;">	<b><?= $a->owner; ?></b></span>
		<small><i>(<?= $a->time; ?>)</i></small><br/>
		<span style="color:<?= $a->options; ?>;"><?= $a->message ?></span><br/>
		<?php if ($a->picture) : ?>
			<img src="<?= $a->picture ?>"/><br/>
		<?php endif; ?>
	</div>
<?php endforeach; ?>
