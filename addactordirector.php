<!DOCTYPE html>
<html>
	<head>
		<title>
			Add an Actor or Director
		</title>
		<script>
			function checkInput() {
				var first = document.getElementById('first');
				var last = document.getElementById('last');
				var dob = document.getElementById('dob');
				var alertString = "";
				if(first && first.value && last && last.value && dob && dob.value) {
					return true;
				}
					
				if(!first || !first.value)
					alertString += "Please include a first name.\n";
				if(!last || !last.value)
					alertString += "Please include a last name.\n";
				if(!dob || !dob.value)
					alertString += "Please include a date of birth\n";
				alert(alertString);
				return false;
			}
				
		</script>
	</head>
	<body style="background-color:powderblue;">
	<div style="width: 800px; margin: 0 auto;">
		<h1>Add an Actor or Director</h1>
		
		<form method="GET" onsubmit="return checkInput();">
			<p style="margin:0; padding:0;">Type:</p>
			<select name="type">
			<option>Actor
			<option>Director
			</select>
			<br/><br/>
			<p style="margin:0; padding:0;">First Name:</p>
			<input type="text" name="first" id="first" size=20 maxlength=20>
			<br/><br/>
			<p style="margin:0; padding:0;">Last Name:</p>
			<input type="text" name="last" id="last" size=20 maxlength=20>
			<br/><br/>
			<p style="margin:0; padding:0">Sex:</p>
			<Select name="sex">
			<option>Male
			<option>Female
			</select>
			<br/><br/>
			<p style="margin:0; padding:0">Date of Birth (year-month-day)</p>
			<input type="text" name="dob" id="dob" size=12 maxlength=10>
			<br/><br/>
			<p style="margin:0; padding:0">Date of Death (Leave blank if still alive)</p>
			<input type="text" name="dod" id="dod" size=12 maxlength=10>
			<br/><br/>
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
			
			$first=$_GET["first"];
			$last=$_GET["last"];
			$type=$_GET["type"];
			$sex=$_GET["sex"];
			$dob=$_GET["dob"];
			$dod=$_GET["dod"];
			
			if($first && $last && $type && $sex && $dob) {
				$rs1 = mysql_query("select * from MaxPersonID", $cxn);
				$idrow = mysql_fetch_row($rs1);
				$id = $idrow[0];
				
				mysql_query("UPDATE MaxPersonID SET id = id + 1", $cxn);
				if($type == "Actor") {
					if($dod)
						$insert_query = "INSERT INTO " . $type . " VALUES " . "('" . $id . "', '" . $last . "', '" . $first . "', '" . $sex . "', '" . $dob . "', '" . $dod . "')";
					else
						$insert_query = "INSERT INTO " . $type . " (id, last, first, sex, dob) VALUES " . "('" . $id . "', '" . $last . "', '" . $first . "', '" . $sex . "', '" . $dob . "')";
				}
				else {
					if($dod)
						$insert_query = "INSERT INTO " . $type . " VALUES " . "('" . $id . "', '" . $last . "', '" . $first . "', '" . $dob . "', '" . $dod . "')";
					else
						$insert_query = "INSERT INTO " . $type . " (id, last, first, dob) VALUES " . "('" . $id . "', '" . $last . "', '" . $first . "', '" . $dob . "')";
				}
				echo "<br>";
				$res = mysql_query($insert_query, $cxn);
				
				
			}
			else {
			}
				
			
			
			mysql_close($cxn);
		?>
		</div>
	</body>


</html>