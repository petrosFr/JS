<?php
$myfile = fopen($_POST['filename'], "w") or die("Unable to open file!");
$txt = $_POST['data'];
fwrite($myfile, $txt);
fclose($myfile);
?>
