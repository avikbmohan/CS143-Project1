<!DOCTYPE html>
<html>
  <head>
    <title>
      View Person
    </title>
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

       
       $nameQuery = "SELECT DISTINCT * FROM Director d WHERE d.id=".$id;
       $res1 = mysql_query($nameQuery, $cxn);
       $data = mysql_fetch_row($res1);
       if (is_null($data[0])) {       
        $nameQuery = "SELECT DISTINCT * FROM Actor a WHERE a.id=".$id;
        $res1 = mysql_query($nameQuery, $cxn);
        $data = mysql_fetch_row($res1);
       }

      echo "<h2 align='center' style=\"font-family:courier;\">".$data[2]." ".$data[1]."</h2>";

      $moviesDirectedQuery = "SELECT DISTINCT * FROM MovieDirector md JOIN Movie m ON md.mid = m.id WHERE md.did=".$id;
       $res2 = mysql_query($moviesDirectedQuery, $cxn);
       if (mysql_num_rows($res2)==0){
         echo "<h4> No Directed Movies Listed.<h4><br>";
       } else {
         echo "<h4> Movies Directed:<h4><br>";
         $num2 = mysql_num_fields($res2);       
         echo "<table border='1', cellpadding=5>";
         echo "<tr>";
         for($i=0; $i < $num2; $i++){
	  if ($i == 0){ echo "<th>"; echo "Movie ID"; echo "</th>";
          } else {
	  echo "<th>"; echo ucfirst(mysql_field_name($res2, $i)); echo "</th>";
         }}
         echo "<th> Link to Info </th>";
         echo "</tr>";
         while($row = mysql_fetch_row($res2)){
          echo "<tr>";
          for($i = 0; $i < $num2; $i++){
           if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
           else { echo "<td> " . $row[$i] . " </td>";}
          }
	 echo "<td><center><a href=\"movie.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	 echo "</tr>";
	 }		 
         echo "</table>";
       }

       $moviesActedQuery = "SELECT DISTINCT * FROM Movie m JOIN MovieActor ma ON m.id=ma.mid where ma.aid=".$id;
      
       $res3 = mysql_query($moviesActedQuery, $cxn);
       if (mysql_num_rows($res3)==0){
         echo "<h4> No Listed Movies Acted in.</h4>";
       } else {
         echo "<h4> Movies Acted in:</h4>";
         $num3 = mysql_num_fields($res3);

         echo "<table border='1', cellpadding=5>";
         echo "<tr>";
         for($i=0; $i < $num3; $i++){
	  if ($i == 0){ echo "<th>"; echo "Movie ID"; echo "</th>";
          } else {
	  echo "<th>"; echo ucfirst(mysql_field_name($res3, $i)); echo "</th>";
         }}
         echo "<th> Link to Info </th>";
         echo "</tr>";
         while($row = mysql_fetch_row($res3)){
          echo "<tr>";
          for($i = 0; $i < $num3; $i++){
           if (is_null($row[$i])){ echo "<td align=\"center\">---</td>";}
           else { echo "<td>" . $row[$i] . "</td>";}
          }
	 echo "<td><center><a href=\"movie.php?id=".$row[0]."\"><img src=info.png height=10 width=10></a></center></td>";
	  echo "</tr>";
         }		 
        echo "</table>";
       }
       mysql_close($cxn);
    ?> 

</body>
</html>
