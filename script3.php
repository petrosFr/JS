<?php
$v1=$_POST["classname"];
$v2=$_POST["threshold"];
$pngname = "pictures_uml/CModel_".$v1."_".$v2."_modWP.png";
$generatePhoto = "/usr/lib64/jvm/java-1.8.0-openjdk-1.8.0/jre/bin/java -jar plantuml.jar pictures_uml/CModel_".$v1."_".$v2."_modWP.txt";
$output = shell_exec($generatePhoto);
//echo "<img src=".$pngname." alt=\"Unknown value\">";
echo $pngname;
$json = 'https://www.google.com';
$json_output = json_decode($json, true);
?>
