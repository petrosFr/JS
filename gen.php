<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = $_POST['data'];
fwrite($myfile, $txt);
fclose($myfile);
?>
