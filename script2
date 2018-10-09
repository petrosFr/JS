<?php
$v1=$_POST["classname"];
$v2=$_POST["threshold"];
$pngname = "pictures_uml/CModel_".$v1."_".$v2.".png";
$generatePhoto = "/usr/lib64/jvm/java-1.8.0-openjdk-1.8.0/jre/bin/java -jar /etudiants/deptinfo/p/pari_p1/workspace/linked_itemset_sub16/uml.jar pictures_uml/CModel_"+v1+"_"+v2+"_mod.txt";
$output = shell_exec($generatePhoto);
echo "<img src=".$pngname." alt=\"Unknown value\">";
?>
