<!DOCTYPE html>
<html>
  <head>
    <title>
      Browse Movies
    </title>
  </head>
  <body style="background-color:powderblue;">
    <h4 style="font-family:courier;"><a href='main.php'>Go Back to Main Page</a></h4>    
    <h4 style="font-family:courier;"><a href='search.php'>Go to Search Page</a></h4>    
    <h1 style="font-family:courier;">Movies:</h1>
    <h3 style="font-family:courier;">Sorted by Title</h3>

<!---The paging mechanism below borrows from phpjabbers.com "PHP/MySQL Select Data and Split on Pages"--->

    <?php
       session_start();
       $cxn = mysql_connect("localhost", "cs143", "");
       if(!$cxn){
         $err = mysql_error($cxn);
         echo "ERROR!";
         print("Error: $err");
         exit(1);
       }
       mysql_select_db("CS143", $cxn);

       if (isset($_GET["page"])) {
         $page = $_GET["page"]; 
       } else {
         $page = 1; 
       } 
       
       $resultsPerPage=20;

       $offset = ($page - 1) * $resultsPerPage;
       $baseQuery = "Select Distinct * From Movie Order By id ASC LIMIT ".$resultsPerPage." OFFSET ".$offset;


       $res = mysql_query($baseQuery, $cxn);
       $num = mysql_num_fields($res);


       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       echo "<th> Movie ID </th>";
       for($i=1; $i < $num; $i++){
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


       $sql = "Select Count(Distinct id) As total From Actor";
       $result = mysql_query($sql, $cxn);
       $row = mysql_fetch_assoc($result);
       $totalPages = ceil($row["total"] / $resultsPerPage);
       for($it = 1; $it < $totalPages; $it++){
         echo "<a href='browseActor.php?page=".$it;
         echo "?resPerPage=".$resultsPerPage."'";
         if ($it == $page) echo " class='curPage'";
         echo ">".$it."</a> ";
       };
       mysql_close($cxn);
    ?> 

</body>
</html>
