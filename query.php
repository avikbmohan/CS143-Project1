<!DOCTYPE html>
<html>
  <head>
    <title>
      CS 143 - Project 1A
    </title>
  </head>
  <body style="background-color:powderblue;">
    
    <h1 style="font-family:courier;">Enter Query:</h1>
    
    <form method="GET">
      <textarea name="query" rows='6' cols='56' name='query'></textarea>
      <input type="submit" value="Submit">   
    </form>
    
    <?php
       //$cxn is for "Connection"
       $cxn = mysql_connect("localhost", "cs143", "");
 //      if(!#cxn){
 //        $err = mysql_error($cxn);
 //        print("Error: $err");
 //        exit(1);
 //      }
       mysql_select_db("CS143", $cxn);
       $query = $_GET["query"];
       if($query){
         $res = mysql_query($query, $cxn);
         $num = mysql_num_fields($res);
         echo "<table border='1'>";
         echo "<tr>";
         for($i=0; $i < $num; $i++){
	   $fetchedName = mysql_field_name($res, $i);
	   echo "<th>"; echo $fetchedName; echo "</th>";
	 }
	 echo "</tr>";
		       
	 while($row = mysql_fetch_row($res)){
	   echo "<tr>";
	   for($j = 0; $j < $num; $j++){
	     echo "<td>" . $row[j] . "</td>";
	   }
	   echo "</tr>";
	 }
	 echo "</table>";
       } 
       mysql_close($cxn);
    ?>  
</body>
</html>
