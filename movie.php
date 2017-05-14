<!DOCTYPE html>
<html>
  <head>
    <title>
      View Movie
    </title>
	<script>
		function checkInput() {
			var name = document.getElementById('name');
			var comment = document.getElementById('comment');
			var alertString = "";
			if(name && name.value && comment && comment.value)
				return true;
			else
				if(!name || !name.value)
					alertString += "Please include your name.\n";
				if(!comment || !comment.value)
					alertString += "Please inlude a comment.\n";
				alert(alertString);
				return false;
		}
	</script>
  </head>
  <body style="background-color:powderblue;">
    <h4 style="font-family:courier;"><a href='main.php'>Go Back to Main Page</a></h4>    
    <h4 style="font-family:courier;"><a href='search.php'>Go to Search Page</a></h4>    
    <?php
       if (isset($_GET["id"])) {
        $id = $_GET["id"]; 
       } else {
        $id = 1; 
       } 
       
       $cxn = mysql_connect("localhost", "cs143", "");
       if(!$cxn){
         $err = mysql_error($cxn);
         echo "ERROR!";
         print("Error: $err");
         exit(1);
       } mysql_select_db("CS143", $cxn);

       
       $nameQuery = "SELECT DISTINCT * FROM Movie m WHERE m.id=".$id;
       $res1 = mysql_query($nameQuery, $cxn);
       $data = mysql_fetch_row($res1);
       echo "<h2 align='center' style=\"font-family:courier;\">".$data[1]."<br>".$data[2]."</h2>";
       $res2 = mysql_query($nameQuery, $cxn);
         echo "<h4> Basic Info:<h4><br>";
         $num2 = mysql_num_fields($res2);       
         echo "<table border='1', cellpadding=4>";
         echo "<tr>";
         for($i=0; $i < $num2; $i++){
             $fetched = mysql_field_name($res2, $i);
	     echo "<th>"; echo ucfirst(mysql_field_name($res2, $i)); echo "</th>";
         }
         echo "</tr>";
         while($row = mysql_fetch_row($res2)){
          echo "<tr>";
          for($i = 0; $i < $num2; $i++){
           if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
           else { echo "<td>" . $row[$i] . "</td>";}
          }
	 echo "</tr>";
	 }		 
         echo "</table>";



      $directorsQuery = "SELECT DISTINCT * FROM MovieDirector md LEFT JOIN Movie m ON md.mid = m.id WHERE m.id=".$id;
       $res2 = mysql_query($directorsQuery, $cxn);
       if (mysql_num_rows($res2)==0){
         echo "<h4> No Listed Director.<h4><br>";
       } else {
         echo "<h4> Director:<h4><br>";
         $num2 = mysql_num_fields($res2);       
         echo "<table border='1', cellpadding=4>";
         echo "<tr>";
         for($i=0; $i < $num2; $i++){
           $fetched = mysql_field_name($res2, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res2, $i)); echo "</th>";
         }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res2)){
        echo "<tr>";
        for($i = 0; $i < $num2; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
        echo "</table>";
       }

       $actorsQuery = "SELECT DISTINCT ma.aid, a.first, a.last, ma.role FROM Movie m JOIN MovieActor ma ON m.id=ma.mid JOIN Actor a on ma.aid = a.id WHERE m.id=".$id;
      
       $res3 = mysql_query($actorsQuery, $cxn);
       if (mysql_num_rows($res3)==0){
         echo "<h4> No Listed Actors.</h4>";
       } else {
         echo "<h4> Actors:</h4>";
         $num3 = mysql_num_fields($res3);
         echo "<table border='1', cellpadding=4>";
         echo "<tr>";
         for($i=0; $i < $num3; $i++){
           $fetched = mysql_field_name($res3, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res3, $i)); echo "</th>";
         }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res3)){
        echo "<tr>";
        for($i = 0; $i < $num3; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
        echo "</table>";
       }
	   
	   

      $reviewsQuery = "SELECT DISTINCT * FROM Review r LEFT JOIN Movie m ON r.mmid = m.id WHERE m.id=".$id;
       $res2 = mysql_query($reviewsQuery, $cxn);
       if (mysql_num_rows($res2)==0){
         echo "<h4> No Listed Reviews.<h4><br>";
       } else {
         echo "<h4> Reviews:<h4><br>";
         $num2 = mysql_num_fields($res2);       
         echo "<table border='1', cellpadding=4>";
         echo "<tr>";
         for($i=0; $i < $num2; $i++){
             $fetched = mysql_field_name($res2, $i);
	     echo "<th>"; echo mysql_field_name($res2, $i); echo "</th>";
         }
         echo "</tr>";
         while($row = mysql_fetch_row($res2)){
          echo "<tr>";
          for($i = 0; $i < $num2; $i++){
           if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
           else { echo "<td>" . $row[$i] . "</td>";}
          }
	 echo "</tr>";
	 }		 
         echo "</table>";
       }

       mysql_close($cxn);
    ?>
	<h4>Add a comment</h4>
		<form method="GET" onsubmit="return checkInput();">
			Name:<br>
			<input type="text" name="name" id="name" size=20 maxlength=20><br><br>Score:<br>
			<select name="score">
			<option>1
			<option>2
			<option>3
			<option>4
			<option>5
			</select><br><br>Comment:<br>
			<textarea name="comment" id="comment" rows=6 cols=50></textarea>
			<br><br>
			<input type="submit" value="Submit">
			<?php
				$id = $_GET['id'];
				echo "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">";
			?>
	
		</form>
	<?php
		$cxn = mysql_connect("localhost", "cs143", "");
		if(!$cxn){
			$err = mysql_error($cxn);
			print("Error: $err");
			exit(1);
		}
		mysql_select_db("CS143", $cxn);
		
		$name = $_GET['name'];
		$score = $_GET['score'];
		$id = $_GET['id'];
		$comment = $_GET['comment'];
		if ($name && $comment) {
			$query = "INSERT INTO Review VALUES ('" . $name . "', NOW(), '" . $id . "', '" . $score . "', '" . $comment . "')";
			$rs = mysql_query($query, $cxn);
		}
		mysql_close($cxn);
			
	?>

</body>
</html>
