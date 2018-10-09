<!DOCTYPE html>
<html lang="en">

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


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
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

  <!-- Main jumbotron for a primary marketing message or call to action -->

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
  <!-- /container -->


  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    var classNames;

    $.getJSON('class.json', function(json) {
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
            var lines = allText.split('\n');
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

  </script>
</body>

</html>
