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
    <div style="float:left; position:absolute; font-size:16px">
        <?php if (isset($_SESSION['name'])) : ?>
            <i>Welcome home</i>
            <em><?= $_SESSION['name']; ?></em>
        <?PHP endif; ?>
    </div>
    <img class="sandwitch2" src="pages/img/background.gif"/>
    <img class="sandwitch1" src="pages/img/header.png"/>
	<!-- <header>[Home Page]<small><i>v.4.8</i></small></header> -->
</div>
<body onload="clock()">
	<div id="left">
		<?php require 'constants/nav.php'; ?>
		<div id="info">
			<p>This is the main page where you can view the changelogs and the 5 newest users that registered.</p>
			<p>Log in or sign up in the [Profile] tab.</p>
			<p>Check out either the [Messageboard] or the [Fileboard] to post messages or images publicly to the site.</p>
			<p>View the [About] page to read on why this is a thing.</p>
			<p>Visit the [Archive] to look up user profiles.</p>
			<p>Read the [Special Thanks] to see the important people behind this site.</p>
			<p>View the "Support Me" page aka [Thanks] to view donation links.</p>
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
		<img src="pages/img/header.jpg" class="main">
		<p id="time"></p>
		<header>Nae nae right into the grave.</header>
		<small>Out of excitment of progress a <u>changelog</u> was meant to
		keep track of the changes but is absent.</small>
        <br/><br/>
        <?php if (isset($_SESSION['name'])) : ?>
            <div id="rates">
                <h2><i>OFFICIAL R8's</i></h2>
                <table>
                    <tr>
                        <th><h4>Mark Zuckerburg</h4></th>
                        <th><h4>Jack Dorsey</h4></th>
                    </tr>
                    <tr>
                        <td><img src="pages/img/mark-zuckerberg.jpg"/></td>
                        <td><img src="pages/img/jack-dorsey.jpg"/></td>
                    </tr>
                    <tr>
                        <td><em>"Good job team."</em></td>
                        <td><em>"Will someone please<br/> fuck my wife."</em></td>
                    </tr>
                    <br/>
                    <tr>
                        <th><h4>Richard Stallman</h4></th>
                        <th><h4>Gabriel Weinberg</h4></th>
                    </tr>
                    <tr>
                        <td><img src="pages/img/Richard-Stallman.jpg"/></td>
                        <td><img src="pages/img/gabriel_weinberg.jpg"/></td>
                    </tr>
                    <tr>
                        <td><em>"mmmm tiddies."</em></td>
                        <td><em>"Perplestuff is the<br/> best goy."</em></td>
                    </tr>
                    <tr>
                        <th><h4>Ian Murdock</h4></th>
                        <th><h4>Sundar Pichai</h4></th>
                    </tr>
                    <tr>
                        <td><img src="pages/img/ian-murdock.jpg"/></td>
                        <td><img src="pages/img/sundar-pichai.jpg"/></td>
                    </tr>
                    <tr>
                        <td><em>"The cops didnt like me."</em></td>
                        <td><em>"Give me more virgin blood."</em></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
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
