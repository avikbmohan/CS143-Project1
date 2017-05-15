+<!DOCTYPE html>
<html>
  <head>
    <title>
      Search
    </title>
  </head>
  <body style="background-color:powderblue;">
    <h1 align='center' style="font-family:Comic Sans MS;">Welcome to the Search Page!</h1>
    <center><img src="picFromTheOdysseyOnline.jpg" height='225' width='500'></center>
    <h3 style="font-family:courier;"><a href='main.php'>Go Back to Main Page</a></h3>
    <h3 style="font-family:courier;"><a href='browse.php'>Go to Browse Page</a></h3> 
    <h3 style="font-family:courier;"><a href='search.php'>Reset Search</a></h3>        <h3>Search People:</h3>
    <?php 
       echo "<form method=\"get\"> <input type='text' name='query'> <input type=\"submit\"> </form>";
       if($_GET["query"]){
       $cxn = mysql_connect("localhost", "cs143", "");
       if(!$cxn){
         $err = mysql_error($cxn);
         echo "ERROR!";
         print("Error: $err");
         exit(1);
       }
       mysql_select_db("CS143", $cxn);
       $queryX = explode(" ", $_GET['query']);

       for ($i = 0; $i < count($queryX); $i ++){
	if ($i == 0){
          $baseQuery = "Select Distinct * from Actor a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
	} else {
          $baseQuery = $baseQuery."UNION Select Distinct * from Actor a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; }}
       $res = mysql_query($baseQuery, $cxn);
       $num = mysql_num_fields($res);
       
       echo"<br><h4>Actors:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";
			 
       for ($i = 0; $i < count($queryX); $i ++){
	if ($i == 0){
       $baseQuery = "Select Distinct * from Director a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
	} else {
          $baseQuery = $baseQuery."UNION Select Distinct * from Director a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; }}
       $res = mysql_query($baseQuery, $cxn);
       $num = mysql_num_fields($res);
       
       echo"<br><h4>Directors:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";


       mysql_close($cxn);
			  }
    ?> 
		      
		      <h3>Search Movies:</h3>
     <?php 
       echo "<form method=\"get\"> <input type='text' name='query1'> <input type=\"submit\"> </form>";
       if($_GET["query1"]){
       $cxn = mysql_connect("localhost", "cs143", "");
       if(!$cxn){
         $err = mysql_error($cxn);
         echo "ERROR!";
         print("Error: $err");
         exit(1);
       }
       mysql_select_db("CS143", $cxn);
       
       $queryX = explode(" ", $_GET['query1']);

       for ($i = 0; $i < count($queryX); $i ++){
	if ($i == 0){
          $baseQuery = "Select Distinct * from Movie a where a.title like '%".$queryX[$i]."%'"; 
	} else {
          $baseQuery = $baseQuery."UNION Select Distinct * from Movie a where a.title LIKE '%".$queryX[$i]."%'"; }}
       $res = mysql_query($baseQuery, $cxn);
       $num = mysql_num_fields($res);

       echo"<br><h4>Movies:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Info </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"movie.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";
       mysql_close($cxn);
       }
 ?> 

		      
		      <h3>Search Actors Directors And Movies:</h3>
     <?php 
       echo "<form method=\"get\"> <input type='text' name='query2'> <input type=\"submit\"> </form>";
       if($_GET["query2"]){
       $cxn = mysql_connect("localhost", "cs143", "");
       if(!$cxn){
         $err = mysql_error($cxn);
         echo "ERROR!";
         print("Error: $err");
         exit(1);
       }
       mysql_select_db("CS143", $cxn);
       
       $queryX = explode(" ", $_GET['query2']);

       for ($i = 0; $i < count($queryX); $i ++){
	if ($I == 0){
          $q1 = "Select Distinct * from Actor a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
          $q2 = "Select Distinct * from Director a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
          $q3 = "Select Distinct * from Movie a where a.title like '%".$queryX[$i]."%'"; 
	} else {
          $q1 = $q1."UNION Select Distinct * from Actor a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
	 $q2 = $q2."UNION Select Distinct * from Director a where a.first like '%".$queryX[$i]."%' OR a.last like '%".$queryX[$i]."%'"; 
          $q3 = $q3."UNION Select Distinct * from Movie a where a.title LIKE '%".$queryX[$i]."%'"; }}

       $res1 = mysql_query($q1, $cxn);
       $num1 = mysql_num_fields($res1);
       $res2 = mysql_query($q2, $cxn);
       $num2 = mysql_num_fields($res2);
       $res3 = mysql_query($q3, $cxn);
       $num3 = mysql_num_fields($res3);

       $res = $res1; $num = $num1;
       echo"<br><h4>Actors:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";

       $res = $res2; $num = $num2;
       echo"<br><h4>Directors:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Bio </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . $row[$i] . "</td>";}
        }
        echo "<td><center><a href=\"person.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";


       $res = $res3; $num = $num3;
       echo"<br><h4>Movies:<h4><br>";
       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
           $fetched = mysql_field_name($res, $i);
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }
       echo "<th> Link to Info </th>";
       echo "</tr>";
       while($row = mysql_fetch_row($res)){
        echo "<tr>";
        for($i = 0; $i < $num; $i++){
         if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
         else { echo "<td>" . ($row[$i]) . "</td>";}
        }
        echo "<td><center><a href=\"movie.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	echo "</tr>";
       }		 
       echo "</table>";
       mysql_close($cxn);
       }
 ?> 


  </body>
</html>
