<?php
	if(isset($_POST["username"]) && isset($_POST["pwd"])) {
		$username = htmlspecialchars(addslashes($_POST["username"]));
		$password = htmlspecialchars(addslashes($_POST["pwd"]));

		if($username == "web" && $password == "web") {	
			$_SESSION["logged"] = 1;
			?>
				<script>document.location.href="?p=dashboard";</script>
			<?php
		}
	}
?>
<div align="center">
	<h1>Login</h1>
	<form method="POST">
		Username : <input type="text" name="username"/><br/>
		Password : <input type="password" name="pwd"/><br/>
		<input type="submit" value="press"/>
	</form>
</div>