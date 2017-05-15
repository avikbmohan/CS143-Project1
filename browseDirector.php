<!DOCTYPE html>
<html>
  <head>
    <title>
      Browse Directors
    </title>
  </head>
  <body style="background-color:powderblue;">
    <h4 style="font-family:courier;"><a href='main.php'>Go Back to Main Page</a></h4>    
    <h4 style="font-family:courier;"><a href='search.php?type=Director'>Search Directors</a></h4>    
    <h1 style="font-family:courier;">Directors:</h1>
    <h3 style="font-family:courier;">Sorted by ID/Last Name</h3>
    <form action="browseDirector.php" method="get">

    <?php
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
       $baseQuery = "Select Distinct * From Director Order By id ASC LIMIT ".$resultsPerPage." OFFSET ".$offset;


       $res = mysql_query($baseQuery, $cxn);
       $num = mysql_num_fields($res);


       echo "<table border='1', cellpadding=4>";
       echo "<tr>";
       for($i=0; $i < $num; $i++){
	   if (mysql_field_name($res, $i)[0] =='d'){
             	   echo "<th>"; echo strtoupper(mysql_field_name($res, $i)); echo "</th>";} else{
	   echo "<th>"; echo ucfirst(mysql_field_name($res, $i)); echo "</th>";
       }}
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


       $sql = "Select Count(Distinct id) As total From Director";
       $result = mysql_query($sql, $cxn);
       $row = mysql_fetch_assoc($result);
       $totalPages = ceil($row["total"] / $resultsPerPage);
       for($it = 1; $it < $totalPages; $it++){
         echo "<a href='browseDirector.php?page=".$it;
         echo "?resPerPage=".$resultsPerPage."'";
         if ($it == $page) echo " class='curPage'";
         echo ">".$it."</a> ";
       };
       mysql_close($cxn);
    ?> 

</body>
</html>
