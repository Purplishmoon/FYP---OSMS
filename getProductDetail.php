<?php
include("header.php");
 //echo json_encode($data);
$id =  $_GET['id'];
$SQL = "SELECT pId,unitPrice,qty FROM tblprodstat WHERE pId = '".$id."'";
$Result = mysqli_query($Link,$SQL);
$row = mysqli_fetch_array($Result);;
echo "{\"id\": \"".$id."\", \"unitPrice\": ".$row['unitPrice'].", \"max\": ".$row['qty']."}";
//echo "{id: ".$id.", unitPrice: ".$row['unitPrice']."}";

?>