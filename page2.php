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

  <title>Conceptual Model</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="css/custom.css" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
        var firstTime = true;
        var myVariable = <?php echo(json_encode($_POST["classname"])); ?>;
        var myVariable2 = <?php echo(json_encode($_POST["threshold"])); ?>;
        $('.ge-list').hide();
        $('#div1').load("script.php", {'classname': myVariable ,'threshold': myVariable2}, function(){
                    $("#testimg").hide();
                    $('.ge-list').show();
                    var classNames;

    $.getJSON('pictures_uml/JSONclasses_'+myVariable+'_'+myVariable2+'.json', function(json) {
      for (var i = 0; i < json.length; i++) {
        $(".class-lists").append("<div class='checkbox'> <label><input name='deletedclasses[]' type='checkbox' value='" + json[i] + "' checked>" + json[i] + "</label></div>");
      }
        for (var i = 0; i < json.length; i++) {
        $("#b-class-lists").append("<option value='"+json[i]+"'>"+json[i]+"</option>");
      }
      });



    function readTextFile(file) {

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
                 data: {'data': newtext,'filename':'pictures_uml/CModel_'+myVariable+'_'+myVariable2+'_modW.txt'},
                 success: function(data){
                 $("#testimg").show();
                   $.ajax({
                       url: 'script2.php',
                       type: "POST",
                       dataType:'text',
                       data: {'classname':myVariable,'threshold':myVariable2},
                       success: function(data){
                        $("#testimg").hide();
                          $("#div1").html("<img src=pictures_uml/CModel_"+myVariable+"_"+myVariable2+"_modW.png?timestamp="+new Date().getTime()+">" )
                       }
                   });
                 }
             });
          }
        }
      }
      rawFile.send(null);
    }
    $("#getDeletedclass").click(function() {
      var all, checked, notChecked;
      all = $('input[name="deletedclasses[]"]');
      checked = all.filter(":checked");
      notChecked = all.not(":checked");
      classNames = $(notChecked).map(function (a) {
    return this.value;
  }).get();
    if(firstTime) {
      readTextFile("pictures_uml/CModel_"+myVariable+'_'+myVariable2+".txt");
      firstTime = false;
    } else {
      readTextFile("pictures_uml/CModel_"+myVariable+'_'+myVariable2+"_modW.txt");
    }

  });
    $("#re-script1").click(function() {
    $("#testimg").show();
    var newCalss=$('#b-class-lists :selected').text();
    $.ajax({
        url: 'script.php',
        type: "POST",
        dataType:'text',
        data: {'classname': newCalss ,'threshold': myVariable2},
        success: function(data){
        $("#div2").html( data );
        $("#testimg").hide();
        }
    });
  });
  });
});
</script>
</head>
<body>






    <div class="container home">
    <!-- Example row of columns -->
    <div class="col-md-9" id="div1"></div>

    <div id="testimg">
    <!--<img id="loading" alt="" src="ajax.gif"/>-->
    <svg width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ellipsis" style="background: transparent none repeat scroll 0% 0%;"><!--circle(cx="16",cy="50",r="10")--><circle cx="16" cy="50" r="10" fill="#c7c7c7"><animate attributeName="r" values="10;0;0;0;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="84;84;84;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle><circle cx="16" cy="50" r="10" fill="#51318f"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate></circle><circle cx="16" cy="50" r="10" fill="#3dd3ca"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate></circle><circle cx="16" cy="50" r="10" fill="#e94709"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle><circle cx="16" cy="50" r="10" fill="#c7c7c7"><animate attributeName="r" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle></svg>
    <h2>PLEASE WAIT...</h2>
    </div>
    <div class="col-md-2 ge-list ">
    
      <form class="" id="d-c">
        <h4> Related Classes : </h4>
        <div class="class-lists"> </div>
        <button  id="getDeletedclass" type="button" class="btn btn-success">OK</button>
      </form>
       <form class="" id="c-b">
        <div class="b-class-lists">
    <select id="b-class-lists" name="class">
        
         </select> 
 

         </div>
        <button  id="re-script1" type="button" class="btn btn-success">OK</button>  
      </form>
    </div>

  </div>
    <div class="col-md-9" id="div2"></div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="js/bootstrap.min.js"></script>

</body>
</html>
