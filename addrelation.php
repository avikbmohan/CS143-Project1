<!DOCTYPE html>
<html>
	<head>
		<title>Add a Relation</title>
		<script>
			var needRole = true;
			function enableRole(){
				document.getElementById('roleField').style.display = 'block';
				document.getElementById('actornames').style.display = 'block';
				document.getElementById('directornames').style.display = 'none';
				needRole = true;
			}
			function disableRole(){
				document.getElementById('roleField').style.display = 'none';
				document.getElementById('actornames').style.display = 'none';
				document.getElementById('directornames').style.display = 'block';
				needRole = false;
			}
			function checkInput(){
				var input = document.getElementById('role');
				var type =  document.getElementById('type');
				if ((input && input.value) || !needRole)
					return true;
				else
					alert("Please insert a role for the Actor.")
					return false;
			}
		</script>
	</head>
	<body style="background-color:powderblue;">
	<div style="width: 800px; margin: 0 auto;">
		<h1>Add a Relation</h1>
		<form method="GET" onsubmit="return checkInput();">
		<input type="radio" name="type" id="type" value="actor" onmouseup="enableRole();" checked>Actor
		<input type="radio" name="type" id="type" value="director" onmouseup="disableRole();">Director
		<br><br>
		<span id="actornames">
		Actor: <br>
		<select name="actor">
		<?php
			$cxn = mysql_connect("localhost", "cs143", "");
			if(!$cxn){
				$err = mysql_error($cxn);
				print("Error: $err");
				exit(1);
			}
			mysql_select_db("CS143", $cxn);
			$query = "Select id, last, first, dob from Actor order by first, last, id";
			$rs = mysql_query($query, $cxn);
			while($row = mysql_fetch_row($rs))
				echo "<option value=\"$row[0]\">$row[2] $row[1] ($row[3])";
			mysql_close($cxn);
		?>
		</select>
		</span>
		<span id="directornames" style="display: none"s>
		Director: <br>
		<select name="director">
		<?php
			$cxn = mysql_connect("localhost", "cs143", "");
			if(!$cxn){
				$err = mysql_error($cxn);
				print("Error: $err");
				exit(1);
			}
			mysql_select_db("CS143", $cxn);
			$query = "select id, last, first, dob from Director order by first, last, id";
			$rs = mysql_query($query, $cxn);
			while($row = mysql_fetch_row($rs))
				echo "<option value=\"$row[0]\">$row[2] $row[1] ($row[3])";
			mysql_close($cxn);
		?>
		</select>
		</span>
		<br><br>
		Movie: <br>
		<select name="movie">
		<?php
			$cxn = mysql_connect("localhost", "cs143", "");
			if(!$cxn){
				$err = mysql_error($cxn);
				print("Error: $err");
				exit(1);
			}
			mysql_select_db("CS143", $cxn);
			$query = "select id, title, year from Movie order by title";
			$rs = mysql_query($query, $cxn);
			while($row = mysql_fetch_row($rs))
				echo "<option value=\"$row[0]\">$row[1] ($row[2])";
			mysql_close($cxn);
		?>
		</select>
		<br><br>
		
		<span id="roleField">
		Role<br>
		<input type="text" name="role" id="role" size=50 maxlength=50>
		<br><br></span>
		<input type="submit" value="Submit">
		</form>
		
		<?php
			$cxn = mysql_connect("localhost", "cs143", "");
			if(!$cxn){
				$err = mysql_error($cxn);
				print("Error: $err");
				exit(1);
			}
			mysql_select_db("CS143", $cxn);
			$mid=$_GET['movie'];
			$aid=$_GET['actor'];
			$did=$_GET['director'];
			$role = mysql_real_escape_string($_GET['role'], $cxn);
			$type = $_GET['type'];
			if($mid) {
	
				if($type == "actor"){
					$query = "INSERT INTO MovieActor VALUES " . "('" . $mid . "', '" . $aid . "', '" . $role . "')";
				}
				else
					$query = "INSERT INTO MovieDirector VALUES " . "('" . $mid . "', '" . $did . "')";
				echo "<br>";
				$rs = mysql_query($query, $cxn);
				if($rs)
					echo "";
				else {
					
					echo "";
				}
			}
				
			
			mysql_close($cxn);
		?>
	</div>
	</body>

</html>
