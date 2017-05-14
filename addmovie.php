<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Add a Movie
		</title>
		<script>
			function checkInput() {
				var name = document.getElementById('name');
				var company = document.getElementById('company');
				var year = document.getElementById('year');
				var alertString = "";
				if(name && name.value && company && company.value && year && year.value)
					return true;
				if(!name || !name.value)
					alertString += "Please include a movie title.\n";
				if(!company || !company.value)
					alertString += "Please include a company.\n";
				if(!year || !year.value)
					alertString += "Please include a year.\n";
				alert(alertString);
				return false;
			}
		</script>
	</head>
	<body style="background-color:powderblue;">
	<div style="width: 800px; margin: 0 auto;">
		<h1>Add a Movie</h1>
		
		<form method="GET" onsubmit="return checkInput();">
		<p>Name</p>
		<input type="text" name="name" id="name" size=100 maxlength=100>
		<p>Company</p>
		<input type="text" name="company" id="company" size=50 maxlength=50>
		<p>Year</p>
		<input type="text" name="year" id="year" size=4 maxlength=4>
		<p>Rating</p>
		<select name="rating">
		<option>G
		<option>PG
		<option>PG-13
		<option>R
		<option>NC-17
		<option>surrendere
		</select>
		<p>Genre</p>
		<input type="checkbox" name="g_action" value="Action">Action<br>
		<input type="checkbox" name="g_adult" value="Adult">Adult<br>
		<input type="checkbox" name="g_adventure" value="Adventure">Adventure<br>
		<input type="checkbox" name="g_animation" value="Animation">Animation<br>
		<input type="checkbox" name="g_comedy" value="Comedy">Comedy<br>
		<input type="checkbox" name="g_crime" value="Crime">Crime<br>
		<input type="checkbox" name="g_documentary" value="Documentary">Documentary<br>
		<input type="checkbox" name="g_drama" value="Drama">Drama<br>
		<input type="checkbox" name="g_family" value="Family">Family<br>
		<input type="checkbox" name="g_fantasy" value="Fantasy">Fantasy<br>
		<input type="checkbox" name="g_horror" value="Horror">Horror<br>
		<input type="checkbox" name="g_musical" value="Musical">Musical<br>
		<input type="checkbox" name="g_mystery" value="Mystery">Mystery<br>
		<input type="checkbox" name="g_romance" value="Romance">Romance<br>
		<input type="checkbox" name="g_sci-fi" value="Sci-Fi">Sci-Fi<br>
		<input type="checkbox" name="g_short" value="Short">Short<br>
		<input type="checkbox" name="g_thriller" value="Thriller">Thriller<br>
		<input type="checkbox" name="g_war" value="War">War<br>
		<input type="checkbox" name="g_western" value="Western">Western<br>
		<br>
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
			$name=$_GET["name"];
			$company=$_GET["company"];
			$year=$_GET["year"];
			$rating=$_GET["rating"];
			
			
			if ($name && $year && $company) {
				$rs1 = mysql_query("select * from MaxMovieID", $cxn);
				$idrow = mysql_fetch_row($rs1);
				$id = $idrow[0];
				//echo "Id is " . $id;
				mysql_query("UPDATE MaxMovieID SET id = id + 1");
				$insert_query1 = "INSERT INTO Movie VALUES " . "('" . $id . "', '" . $name . "', '" . $year . "', '" . $rating . "', '" . $company . "')";
				//echo $insert_query1 . "<br>";
				$res1 = mysql_query($insert_query1, $cxn);
				/*
				if($res1)
					echo "Success<br>";
				else
					echo "Error<br>";*/
				
				if(isset($_GET["g_action"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_action"] . "')", $cxn);
				if(isset($_GET["g_adult"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_adult"] . "')", $cxn);
				if(isset($_GET["g_adventure"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_adventure"] . "')", $cxn);
				if(isset($_GET["g_animation"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_animation"] . "')", $cxn);
				if(isset($_GET["g_comedy"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_comedy"] . "')", $cxn);
				if(isset($_GET["g_crime"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_crime"] . "')", $cxn);
				if(isset($_GET["g_documentary"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_documentary"] . "')", $cxn);
				if(isset($_GET["g_drama"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_drama"] . "')", $cxn);
				if(isset($_GET["g_family"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_family"] . "')", $cxn);
				if(isset($_GET["g_fantasy"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_fantasy"] . "')", $cxn);
				if(isset($_GET["g_horror"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_horror"] . "')", $cxn);
				if(isset($_GET["g_musical"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_musical"] . "')", $cxn);
				if(isset($_GET["g_mystery"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_mystery"] . "')", $cxn);
				if(isset($_GET["g_romance"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_romance"] . "')", $cxn);
				if(isset($_GET["g_sci-fi"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_sci-fi"] . "')", $cxn);
				if(isset($_GET["g_short"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_short"] . "')", $cxn);
				if(isset($_GET["g_thriller"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_thriller"] . "')", $cxn);
				if(isset($_GET["g_war"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_war"] . "')", $cxn);
				if(isset($_GET["g_western"]))
					mysql_query("INSERT INTO MovieGenre VALUES " . "('" . $id . "', '" . $_GET["g_western"] . "')", $cxn);
				
				
			}
			else {
				
			}
			
			
			
			mysql_close($cxn);
		
		?>
		
	</div>
	</body>

</html>
