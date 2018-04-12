<?php

// CONTROLLER

$rows = $conf['database']->count('users');
$maxRow = $rows - 4;

$profiles = $conf['database']->between(
    'name, pfp, date',
    'users',
    'id',
    $maxRow,
    $rows
);

?>

<!-- VIEWER -->

<?php require 'constants/header.php'; ?>

<div id="header">
	<header>[Home Page]</header>
</div>

<body onload="clock()">
	<div id="left">
		<?php require 'constants/nav.php'; ?>
		<div id="info">
			<p>This is the main page where you can view the changelogs and the 5 newest users that registered.</p>
			<p>You can log in or sign up in the [Profile] tab.</p>
			<p>You can check out either the [Messageboard] or the [Fileboard] to post messages or images publicly to the site.</p>
			<p>You can view the [About] page to read on why this is a thing.</p>
			<p>You can visit the [Archive] to look up user profiles.</p>
			<p>You can read the [Special Thanks] to see the important people behind this site.</p>
			<p>You can view the "Support Me" page aka [Thanks] to view donation links.</p>
			<b>Please note that visiting this site now and then is all the support I need.</b>
		</div>
	</div>
	<div id="right">
		<div class="memorial">
			<b>Rocky</b>
			<p>2007 - 2017</p>
			<img src="pages/img/rocky.PNG" class="memorial">
		</div><br/>
		<div class="userList">
			<header>[New Users]</header><br/>
			<ul>
					<?php foreach ($profiles as $prof) : ?>
						<li>
						<p><?= $prof->name; ?></p>
						<img src='<?= $prof->pfp; ?>'><br/>
						<p><?= $prof->date; ?></p>
					</li><br/>
					<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div id="center">
		<img src="pages/img/perplestuff.png" class="main">
		<p id="time"></p>
		<header>Nae nae right into the grave.</header>
		<small>Out of excitment of progress a <u>changelog</u> was meant to
		keep track of the changes but is absent.</small>
		<div id="changelog">
			<p class="msg">VERSION 4.7: <small>(I think)</small></p>
			<b>3-18-19</b><br/>
			<ul>
				<li>Added functional login system with reasonable options</li>
				<li>Gave the archive a purpose of searching up user profiles</li>
				<li>Fixed the "wait a billion years to post again" filter error on the messageboard</li>
				<li>Added ranks to users (they dont do anything yet but its nice to have)</li>
				<li>Removed [Feedback] table because its annoying and can be way better</li>
				<li>Gave style to the [About] page</li>
				<li>Removed monero miner and replaced it with a captcha (better for spam control and less annoying than the original miner)</li>
				<li>Changed the Support Me to be on the bottom of the navagation, and added donation adresses instead of just a miner and a smiley indian guy</li>
				<li>Gave more detailed instructions on the left hand side on how to use this site</li>
			</ul>
			<p class="msg">[The Future]</p>
			<ul>
				<li>Will fix the message/image board to fully rely on a database for potentially more options</li>
				<li>Will learn jquery to make this place look more "professional" and ajax to give my boards more functionality</li>
				<li>Will add more changelogs so users dont have to guess whats all changed</li>
			</ul>
		</div>
	</div>
	<!-- <ul>
		< ?php foreach ($tasks as $task) : ?>
	      <li>
				< ?php if ($task ->completed) : ?>
					<strike>< ?= $task ->description; ?></strike>
				< ?php else: ?>
					< ?= $task ->description; ?>
				< ?php endif; ?>
	      </li>
		< ?php endforeach; ?>
	</ul> -->

</body>
<?php require 'constants/footer.php'; ?>
