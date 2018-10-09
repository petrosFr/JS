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
//     //$.getJSON('class.json', function(json) {   pictures_uml/
    $.getJSON('pictures_uml/JSONclasses_'+v1+'_'+v2+'.json', function(json) {
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
    readTextFile("pictures_uml/CModel_"+v1+"_"+v2+".txt");
  });

  });    
        
});
</script>
</head>
<body>

<div id="div1">PLEASE WAIT...</div>
<div id="testimg">
<img id="loading" alt="" src="ajax1.gif"/>
</div>



      <div class="container home">
    <!-- Example row of columns -->
    <div class="col-md-10 ge-image">
      <!--<img src="CModel_Film_30.png" />-->
      <script type="text/javascript">
      document.getElementById('imgaeBox').src= "pictures_uml/CModel_"+v1+"_"+v2+".png";
      </script>
      <!--                      -->
    </div>
    <div class="col-md-2 ge-list ">
      <form class="" id="d-c">
        <h4> Related Classes : </h4>
        <div class="class-lists">

      </div>
        <button  id="getDeletedclass" type="button" class="btn btn-success">Success</button>
      </form>
    </div>

  </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function() {
    
    });
    
    </script>
</body>
</html>
