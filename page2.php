<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Jumbotron Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">



  <!-- Custom styles for this template -->
  <link href="css/custom.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
        var myVariable = <?php echo(json_encode($_POST["classname"])); ?>;
        var myVariable2 = <?php echo(json_encode($_POST["threshold"])); ?>;

        $('#div1').load("script.php", {'classname': myVariable ,'threshold': myVariable2}, function(){
                    $("#testimg").hide();
                    var classNames;
                        var v1 = <?php echo(json_encode($_POST["classname"])); ?>;
                        var v2 = <?php echo(json_encode($_POST["threshold"])); ?>;
                    //$.getJSON('class.json', function(json) {
                    $.getJSON('Classes_'+v1+'_'+v2+'.json', function(json) {
                    //$.getJSON('Classes_Film_99.json', function(json) {
                      console.log(json);
                      for (var i = 0; i < json.length; i++) {
                        console.log(i);
                        $(".class-lists").append("<div class='checkbox'> <label><input name='deletedclasses[]' type='checkbox' value='" + json[i] + "' checked>" + json[i] + "</label></div>");
                      }
                    });


                    function readTextFile(file) {
                      console.log(classNames);
                      var rawFile = new XMLHttpRequest();
                      rawFile.open("GET", file, false);
                      rawFile.onreadystatechange = function() {
                        if (rawFile.readyState === 4) {
                          if (rawFile.status === 200 || rawFile.status == 0) {
                            var allText = rawFile.responseText;
                            var lines = allText.val().split('\n');
                            for (var x = 0; x < lines.length; x++) {
                              for(var y = 0; y < classNames.length; y++)
                              {
                                if((lines[x].indexOf(classNames[y])) !=-1 && (lines[x].indexOf('class')) == -1 ){
                                  lines.splice(x,1);
                                  x=x-1;
                                }
                              }
                            }
                            var newtext = lines.join('\n');
                            for(var y = 0; y < classNames.length; y++)
                            {
                              if((newtext.indexOf('class '+classNames[y])) !=-1 ){
                                var from = newtext.indexOf('class '+classNames[y]);
                                var to  = newtext.indexOf('}');
                                newtext = newtext.substr(0, from) + newtext.substr(to+1);
                              }
                            }


                             $.ajax({
                                 url: 'gen.php',
                                 type: "POST",
                                 dataType:'text',
                                 data: {'data': newtext},
                                 success: function(data){
                                     alert('ok');
                                 }
                             });

                          }
                        }
                      }
                      rawFile.send(null);
                    }




                      $("#getDeletedclass").click(function() {
                  classNames = $('input[name="deletedclasses[]"]:checked').map(function () {
                  return this.value;}).get();
                  readTextFile("CModel_Film_30.txt");
                  });

        });

});
</script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<div id="div1">PLEASE WAIT...</div>
<div id="testimg">
<img id="loading" alt="" src="ajax1.gif"/>
</div>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div  class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="#">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">

      </div>
      <!--/.navbar-collapse -->
    </div>
  </nav>

      <div class="container home">
    <!-- Example row of columns -->
    <div class="col-md-10 ge-image">
      <img src="CModel_Film_30.png" />
    </div>
    <div class="col-md-2 ge-list ">
      <form class="" id="d-c">
        <h4> Choose Classes You Wont To Delete  : </h4>
        <div class="class-lists">

      </div>
        <button  id="getDeletedclass" type="button" class="btn btn-success">Success</button>
      </form>
    </div>

  </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <script>
  $(document).ready(function() {

  });

    </script>
</body>
</html>
