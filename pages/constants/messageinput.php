<div id="scroll"></div>
<div id="post">
	<input type="button" id="refresh" value="Force refresh."/>Auto update.<input type="checkbox" id="autoUpdate"/>Auto scroll.<input type="checkbox" id="autoScroll"/>
	<form action="messageboard" method="POST" enctype="multipart/form-data" id="messageboard">
		<p>Message: <input type="text" name="msg" id="msg" size="35" autofocus /></p>
		<p>Options: <select name="color" id="color">
			<option value="">Choose new color.</option>
			<option value="green">green</option>
			<option value="blue">blue</option>
			<option value="yellow">yello</option>
			<option value="purple">purple</option>
			<option value="orange">orange</option>
			<option value="pink">pink</option>
			<option value="red">red</option>
		</select>
		</p>
		<p>File: <input type="file" name="file" id="file"/></p>
		<input type="submit" value="Submit." id="submit"/><br/>
	</form>
</div>
