<!DOCTYPE html>
<html lang="en">
    <header>
        <title>this is a test.</title>
        <meta charset="UTF-8">
    </header>
    <body>
        <header><h1>test page.</h1></header>
				<ul>
								<?php foreach ($tasks as $task) : ?>
										<li>
												<?php if ($task->completed) : ?>
														<strike><?= $task->description; ?></strike>
												<?php else: ?>
														<?= $task->description; ?>
												<?php endif; ?>
										</li>
								<?php endforeach; ?>
				</ul>
        <!--<ul>
            <li>
                <stong>Name: </strong >< ?= ucwords($tasks['name']); ?>
            </li>
            <li>
                <strong>Job: </strong> < ?= $tasks['job']; ?>
            </li>
            <li>
                <strong>Age: </strong> < ?= $tasks['age']; ?>
            </li>
            <li>
                <strong>Functional: </strong>< ?=$tasks['functional'] ? 'True' : 'False'; ?>
            </li>
            <li>
                <strong>Functional: </strong>
                < ?php if ($tasks['functional']) : ?>
                    <span class="icon">&#9989;</span>
                < ?php else : ?>
                    <span class="icon">&#xf071;</span>
                < ?php endif; ?>
            </li>
        </ul>

        <h2>
            <ul>
                < ?php foreach ($associate as $ex => $val) : ?>
                <li><b>< ?= $ex.':'; ?></b>< ?=$val;?></li>
                < ?php endforeach; ?>
            </ul>
        </h2>
        <h3>
            <ul>
                < ?php foreach ($names as $people) : ?>
                <li>< ?= $people; ?></li>
                < ?php endforeach; ?>
            </ul>
            <ul>
                < ?php
                    foreach ($names as $people) {
                        echo "<li>$people</li>";
                    }
                ?>
            </ul>
        </h3>-->

    </body>
</html>
