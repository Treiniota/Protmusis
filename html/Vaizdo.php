<html>
	<head>
	<title>Viktorina: Testiniai klausimai</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	<body>
		<?php
		ession_start();
		ini_set('display_errors', 'On');
		$mysqli = new mysqli($_SESSION['dbhost'],$_SESSION['dbuser'],$_SESSION['dbpass'],$_SESSION['db']);
		// check connection
		if(mysqli_connect_errno()){
			header("Refresh: 2; url=Killall.php");
			die("neprisijungta: ".$mysqli->connect_error);
		}
		$mysqli->set_charset("UTF8");
		$sql="SELECT Kn FROM ServerInfo";
		if ($result = $mysqli->query($sql))
		{
			$row=$result->fetch_row();
			$Kn=$row['0'];
		}
		else{
			die("Klaida:");
		}
			if(isset($_POST['add'])) {
				if(isset($_POST['add'])) {
					if($Kn<>0){
						$sql="CALL send (".$_SESSION['id'].",".$Kn.",2,\"".mysql_real_escape_string($_POST['Ats'])."\")";
						if($mysqli->query($sql)){
							echo "good";
							header("Refresh: 2; url=Wait.php");
						}
						else{
							echo "bad: ".mysqli_error($mysqli);
							header("Refresh: 10; url=Wait.php");
						}
			}else {
				$sqlr=mysql_query("SELECT Klausimas FROM Klausimai_Vaizdo WHERE  Nr='$Kn'",$conn);
		?>
		<h1>Viktorinos Vaizdo Klausimai</h1>
		<form id="zod" method = "post" action = "<?php $_PHP_SELF ?>">
			<h3><?php echo $Kn.") ".mysql_result($sqlr,0,0)?> </h3>
			<textarea rows="4" cols="50" form="zod" name="Ats" autofocus></textarea>
			<p><input id="Form" name = "add" type = "submit" id = "add" value = "Pateikti"></p>
		</form>
		<form method="LINK" action="Killall.php">
			<p><input type="submit" value="Atsijungti"></p>
		</form>
		<script type="text/javascript">
			var source = new EventSource('Admin/reset.php');
			source.onmessage = function(e) {
				document.getElementById("Form").click();
			};
		</script>
		<?php
			}
		?>
	</body>
</html>