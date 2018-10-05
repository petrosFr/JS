<?php
$classe=$_POST["classname"];
$seuil=$_POST["threshold"];
$pngname = "pictures_uml/CModel_".$classe."_".$seuil.".png";
$filename = "pictures_uml/CModel_".$classe."_".$seuil.".txt";
if (file_exists($pngname)){
    echo "<img src=".$pngname." alt=\"Model\">";
    //echo '<img src="pictures_uml/CModel_Film_60.png" alt="Model" />';
} else {
    $launchphrase = "/usr/lib64/jvm/java-1.8.0-openjdk-1.8.0/jre/bin/java -jar /etudiants/deptinfo/p/pari_p1/workspace/linked_itemset_sub16/lod-cmtest.jar ".$classe." ".$seuil;
    //echo $launchphrase;
    //VERSION POUR CACHER ERREURS
    $output = shell_exec($launchphrase);
    
    //VERSION POUR DEBUGGER
    //$output = shell_exec($launchphrase." 2>&1");
    
    //var_dump($output);
    
    echo "<img src=".$pngname." alt=\"Unknown value\">";
  

    // //////////////////////////////////////////////

    
    // //////////////////////////////////////////////
    
    
    
    
    //echo '<img src="pictures_uml/CModel_Film_60.png" alt="Model" />';
}
//$launchphrase = "/usr/lib64/jvm/java-1.8.0-openjdk-1.8.0/jre/bin/java -Dlog4j.configurationFile=/etudiants/deptinfo/p/pari_p1/workspace/linked_itemset_sub18/src/main/resources/log4j2.xml -jar /etudiants/deptinfo/p/pari_p1/workspace/linked_itemset_sub16/subhitest1.jar ".$classe." ".$seuil;
?>





