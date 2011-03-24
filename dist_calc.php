<?php


if ($_GET["lat"] == "" || $_GET["lon"] == "") {
$lat=40;
$lon=25;
echo "US";
}
else {
$lat=$_GET["lat"];
$lon=$_GET["lon"];


$con = mysql_connect("localhost","jamaicav_airports","notroot");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

// some code
$db_selected = mysql_select_db("jamaicav_airports", $con);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
$sql="SELECT IATA, LAT, LON, ((ACOS(SIN(".$lat." * PI() / 180) * SIN(LAT * PI() / 180) + COS(".$lat." * PI() / 180) * COS(LAT * PI() / 180) * COS((".$lon." - LON) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS DIST, ROUND(SQRT(POW((69.1 * (LAT-".$lat.")), 2) + POW((53 *  LON-".$lon."),2)),1) AS distance from airports order by DIST LIMIT 1";
//$sql = "SELECT `IATA` FROM `airports`";
//echo $sql."\n";

$result = mysql_query($sql) or die(mysql_error());

//$row = mysql_fetch_array($result) or die(mysql_error());
//echo $row['name']. " - ". $row['age'];
//echo $result;
//echo $row;


while($row = mysql_fetch_array($result))
  {
  echo $row['IATA'];
  }


mysql_close($con);
}
?>
