<?php include("header.php"); ?>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
        </script>
<?php

session_start();
if (isset($_SESSION["access_granted"]) && !$_SESSION["access_granted"] ||
   !isset($_SESSION["access_granted"])) {
  $_SESSION["status"] = "You need to log in first";
  header("Location:login.php");
}

// newuser_handler.php
require_once "Dao.php";
$dao = new Dao();
$Propaddnum = (isset($_GET["Propaddnum"])) ? $_GET["Propaddnum"] : "";
$Primowner = (isset($_GET["Primowner"])) ? $_GET["Primowner"] : "";
$address = (isset($_GET["address"])) ? $_GET["address"] : "";

//

if($address=="" && $Propaddnum==""){
$estates = $dao->getOwner($Primowner);
}else if($Propaddnum=="" && $Primowner==""){
$estates = $dao->getPropertyDetails($address);
}else{
$estates = $dao->getPropertyDetails($Propaddnum);
}


?>
<html>
  <body>
    <ul>
    <?php
    echo "<table>";
     echo "<tr> ";
      echo "<th> ". "Address" . " </th>";
      echo "<th> ". "Parcel " . " </th>";
      echo "<th> " . "Owner1" . " </th>";
      echo "<th> " . "Owner2" . " </th>";
      echo "<th> " . "Assessed Value" . " </th>";
      echo "<th> " . "City" . " </th>";
      echo "<th> " . "legal" . " </th>";
      echo "<th> " . "Acerage" . " </th>";
      echo "</tr> ";
      
    foreach ($estates as $estate) {
      echo "<tr> ";
      echo "<td> " . $estate["Address"] . " </td>";
      echo "<td> " . $estate["Parcel"] . " </td>";
      echo "<td> " . $estate["Primowner"] . " </td>";
      echo "<td> " . $estate["Secowner"] . " </td>";
      echo "<td> " . $estate["Totalvalue"] . " </td>";
      echo "<td> " . $estate["City_state"] . " </td>";
      echo "<td> " . $estate["Section"] . " </td>";
      echo "<td> " . $estate["Acres"] . " </td>";
      echo "<td><a href='detail.php?Parcel=" . $estate["Parcel"] . "'>"." More Data". "</a></td>";
      echo "</tr> ";
    }
    echo "</table>";

?>
<?php include("footer.php"); ?>
