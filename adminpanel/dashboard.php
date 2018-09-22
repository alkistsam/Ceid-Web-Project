<?php
	if(isset($_GET["action"])) {
		switch(htmlspecialchars(addslashes($_GET["action"]))) {
			case "changeState":
				if(isset($_GET["id"])) {
					$id = htmlspecialchars(addslashes($_GET["id"]));
					changeState($id);
				}
				break;
			case "addPage":
				if(isset($_POST["pageName"])) {
					$pageName = htmlspecialchars(addslashes($_POST["pageName"]));
					addPage($pageName);
				}
				break;
			case "deletePage":
				if(isset($_GET["id"])) {
					deletePage(htmlspecialchars(addslashes($_GET["id"])));
				}
				break;
		}
	}
?>

<div align="center">
	<h1>Dashboard</h1>

	<h2>Pages</h2>
	<form method="POST" action="?p=dashboard&action=addPage">
		Page URL (or name) : <input type="text" name="pageName"/>
		<input type="submit" value="Add page">
	</form>
	<table>
		<?php
			$pages = json_decode(getPages(),1);

			foreach ($pages as $value) {
				?>
				<tr>
					<td><?php print $value["name"]; ?></td>
					<td><a style="color: red;" href="?p=dashboard&action=deletePage&id=<?php print $value["id"]; ?>">DELETE</a></td>
				</tr>
				<?php
			}
		?>
	</table>

	<h2>Events</h2>
	<table border="1">
	<?php
		$events = json_decode(getEvents("all",""),1);

		foreach ($events as $value) {
			$showState = ($value["show"] == 0) ? "SHOW" : "HIDE";
			?>
			<tr>
				<td><?php print $value["owner"]; ?></td>
				<td><?php print $value["name"]; ?></td>
				<td><a style="color: red;" href="?p=dashboard&action=changeState&id=<?php print $value["id"]; ?>"><?php print $showState; ?></a></td>
			</tr>
			<?php
		}
	?>
	</table>
</div>