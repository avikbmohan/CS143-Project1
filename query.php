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
   if(!#cxn){
     $err = mysql_error($cxn);
     print("Error: $err");
     exit(1);
   }
   mysql_select_db("CS143", $mysql);
   $query = $_GET["query"];
   if($query){
     $res = msql_query($query, $cxn);
