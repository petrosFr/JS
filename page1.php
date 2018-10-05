 <!DOCTYPE HTML>
<html>
<head> 
<title>Conceptual Model </title>

</head>



<body>

<h1>Linked Open Data - Conceptual Model</h1>

<ul style="color:red;"> <?php 
if (isset($error)) {
    echo $error;
}
?> </ul>


<form action="page2.php" method="post">
Class Name : <input type="text" name="classname"> <br> <br> <!--  <select name="classname">
    <option value="Film">Film</option>
%    <option value="PopulatedPlace">Populated Place</option>
%    <option value="Artist">Artist</option>
%    <option value="Person">Person</option>
%    <option value="Organisation">Organisation</option>
%    <option value="SportsTeam">SportsTeam</option>
%  </select><br>-->
Threshold : <input type="text" name="threshold">%<br>
<input type="submit">
<input type="reset">
</form>


</body>
</html> 
