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
        var onlyLong;
        var myVariable = <?php echo(json_encode($_POST["classname"])); ?>;
        var myVariable2 = <?php echo(json_encode($_POST["threshold"])); ?>;
        $('.ge-list').hide();
        $('#div1').load("script.php", {'classname': myVariable ,'threshold': myVariable2}, function(){
                    $("#testimg").hide();
                    $('.ge-list').show();
                    var classNames;
                    var propNames;
    $.getJSON('pictures_uml/JSONclasses_'+myVariable+'_'+myVariable2+'.json', function(json) {
      for (var i = 0; i < json.length; i++) {
        $(".class-lists").append("<div class='checkbox'> <label><input name='deletedclasses[]' type='checkbox' value='" + json[i] + "' checked>" + json[i] + "</label></div>");
      }
        for (var i = 0; i < json.length; i++) {
        $("#b-class-lists").append("<option value='"+json[i]+"'>"+json[i]+"</option>");
      }
      });
$.getJSON('pictures_uml/JSONproperties_'+myVariable+'_'+myVariable2+'.json', function(json) {
          for (var i = 0; i < json.length; i++) {
         $("#properties-lists").append("<div class='checkbox testProp'> <label><input  name='propclasses[]' type='checkbox' value='" + json[i] + "'>" + json[i] + "</label></div>");
        }
        }).then(function() {

         $('.testProp input[type="checkbox"]').change(function(){
      //testProp('/lod-cm/etudiants/deptinfo/p/pari_p1/workspace/linked_itemset_sub16/itemsets/dbpedia/2016-10/'+myVariable+'/schemas/schema_minsupElements'+myVariable2+'.txt');
      testProp('/lod-cm/pictures_uml/schemas/schema_minsupElements'+myVariable2+'.txt');
             //         $('.testProp input[type="checkbox"]').attr('disabled','true');
        var val = $(this).val(); // this gives me null
  if (val != null) {
  disPro('/lod-cm/pictures_uml/schemas/schema_minsupElements'+myVariable2+'.txt',val);
  console.log(val);
  }

     });
});
        function disPro(file,val){
        var rawFile = new XMLHttpRequest();
        var allProp;
        var longest;
        var lgth = 0;
        rawFile.open("GET", file, false);
        rawFile.onreadystatechange = function() {
          if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
              var allText = rawFile.responseText;
              var lines = allText.split('\n');
              var all='';
              var chLine=[];
              for(var y = 0; y < lines.length; y++) {
                var n = lines[y].search(val);
                if(n!=-1) {
                  all = all+lines[y];
                  chLine.push(lines[y]);
                }
              }
  var longest = chLine.reduce(function (a, b) { return a.length > b.length ? a : b; });
             console.log(longest);
              onlyLong = longest.split(' ');
             onlyLong.shift();
             onlyLong.splice(-1,1);
             console.log(onlyLong);
              //console.log(chLine);
              $('.testProp input[type="checkbox"]').map(function (a) {
                var t = all.search(this.value);
                if(t == -1) {
                $(this).attr("disabled", true);
              }
              }).get();
            }
          }
        }
        rawFile.send(null);
      }


    function testProp(file) {
       var rawFile = new XMLHttpRequest();
       rawFile.open("GET", file, false);
       rawFile.onreadystatechange = function() {
         if (rawFile.readyState === 4) {
           if (rawFile.status === 200 || rawFile.status == 0) {
             var allText = rawFile.responseText;
             var lines = allText.split('\n');
             for (var x = 0; x < lines.length; x++) {
               console.log(lines[x]);
             }
           }
         }
       }
       rawFile.send(null);
     }

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
    function readProp(file) {
      var rawFile = new XMLHttpRequest();
      rawFile.open("GET", file, false);
      rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4) {
          if (rawFile.status === 200 || rawFile.status == 0) {
            var allText = rawFile.responseText;
            var lines = allText.split('\n');
            //console.log("")
            for (var z = 0; z < lines.length; z++) {
              for(var y = 0; y < propNames.length; y++)
              {
                  tp = lines[z].search(propNames[y]);
                if(tp != -1){
                  lines.splice(z,1);
                  z=z-1;
                }          }
            }
            var newtext = lines.join('\n');
             $.ajax({
                 url: 'gen.php',
                 type: "POST",
                 dataType:'text',
                 data: {'data': newtext,'filename':'pictures_uml/CModel_'+myVariable+'_'+myVariable2+'_modWP.txt'},
                 success: function(data){
                 $("#testimg").show();
                   $.ajax({
                       url: 'script3.php',
                       type: "POST",
                       dataType:'text',
                       data: {'classname':myVariable,'threshold':myVariable2},
                       success: function(data){
                        $("#testimg").hide();
                          $("#div3").html("<img src=pictures_uml/CModel_"+myVariable+"_"+myVariable2+"_modWP.png?timestamp="+new Date().getTime()+">" )
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
  
  
$("#reset-prop").click(function() {
      $('input[name="propclasses[]"]').map(function (a) {
        $(this).prop('checked',false);
       $(this).removeAttr("disabled");
  });
    });
  
  
  $("#delete-prop").click(function() {
    $(notCheckedP).map(function (a) {
      return this.value;
});
    var allP, checkedP, notCheckedP;
    allP = $('input[name="propclasses[]"]');
    checkedP = allP.filter(":checked");
    notCheckedP = allP.not(":checked");
    propNames = $(notCheckedP).map(function (a) {
      for(var t=0;t<onlyLong.length;t++) {
        console.log("NOT CHECKED :"+ this.value);
        console.log("onlyLong :"+ onlyLong[t]);

        yn = false;
        if(onlyLong[t] == this.value ) {
        console.log("onlyLong :"+ onlyLong[t]);
          yn = true;
        }
      }
      if(!yn) {
        console.log('r :' + this.value);
        return this.value;
      }

}).get();
console.log(propNames);
readProp('pictures_uml/CModel_'+myVariable+'_'+myVariable2+'.txt');
  });
  });

    console.log(myVariable2);
      var a = "Threshold = " + myVariable2;
      $("#re-script1").attr('data-original-title', a );

});
</script>
</head>
<body>






    <div class="container home">


     <div class="col-md-12 topNav">
        <a href="index.php"> <span class="glyphicon glyphicon-circle-arrow-left"></span> Back </a>
      </div>


    <!-- Example row of columns -->


    <div id="testimg">
    <!--<img id="loading" alt="" src="ajax.gif"/>-->
    <svg width="200px"  height="200px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-ellipsis" style="background: transparent none repeat scroll 0% 0%;"><!--circle(cx="16",cy="50",r="10")--><circle cx="16" cy="50" r="10" fill="#c7c7c7"><animate attributeName="r" values="10;0;0;0;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="84;84;84;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle><circle cx="16" cy="50" r="10" fill="#51318f"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-1s"></animate></circle><circle cx="16" cy="50" r="10" fill="#3dd3ca"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="-0.5s"></animate></circle><circle cx="16" cy="50" r="10" fill="#e94709"><animate attributeName="r" values="0;10;10;10;0" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="16;16;50;84;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle><circle cx="16" cy="50" r="10" fill="#c7c7c7"><animate attributeName="r" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate><animate attributeName="cx" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" calcMode="spline" dur="2s" repeatCount="indefinite" begin="0s"></animate></circle></svg>
    <h2>Please wait,&nbsp;</h2> <h3>this may take a few seconds...</h3>
    </div>
    <div class="row">
      <div class="col-md-10" id="div1"></div>
 <!--     <div class="col-md-2 ge-list ">
        <form class="" id="d-c">
          <h4> Related Classes : </h4>
          <div class="class-lists"> </div>
          <button  id="getDeletedclass" type="button" class="btn btn-success">OK</button>
        </form>
      </div>
    </div>-->


      <div class="col-md-2 ge-list ">
        <div class="panel panel-success">
          <div class="panel-heading">Related Classes :</div>
          <div class="panel-body">
            <form class="" id="d-c">
              <!--<h4> Related Classes : </h4>-->
              <div class="class-lists"> </div>
              <!--<button  id="getDeletedclass" type="button" class="btn btn-success">OK</button>-->
              <button  id="getDeletedclass" type="button" class="btn btn-success"><span class="glyphicon glyphicon-check"></span></button>
            </form>
          </div>
        </div>

      </div>



    <div class="row">
      <div class="col-md-10" id="div3"></div>


         <div class="col-md-2 ge-list ">
        <div class="panel panel-success">
          <div class="panel-heading">Properties : </div>
          <div class="panel-body">
            <form class="" id="c-b">
            <div id="properties-lists">


             </select>
              </div>
             <!--<button  id="re-script1" type="button" class="btn btn-success">OK</button>-->
            <button  id="delete-prop" type="button" class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span></button>
             <button  id="reset-prop" type="button" class="btn btn-success"><span class="glyphicon glyphicon-repeat"></span></button>
           </form>
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-10" id="div2"></div>


         <div class="col-md-2 ge-list ">
        <div class="panel panel-success">
          <div class="panel-heading">Zoom in</div>
          <div class="panel-body">
            <form class="" id="c-b">
             <div class="b-class-lists">
             <select id="b-class-lists" name="class">

              </select>

              </div>
             <!--<button  id="re-script1" type="button" class="btn btn-success">OK</button>-->
            <button  data-toggle="tooltip" data-placement="left" title="Threshold=" id="re-script1" type="button" class="btn btn-success"><span class="glyphicon glyphicon-zoom-in"></span></button>
           </form>
          </div>
        </div>

      </div>


     <!-- <div class="col-md-2 ge-list ">

         <form class="" id="c-b">
          <div class="b-class-lists">
          <select id="b-class-lists" name="class">

           </select>

           </div>
          <button  id="re-script1" type="button" class="btn btn-success">OK</button>
        </form>
      </div>-->


    </div>
  </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="js/bootstrap.min.js"></script>

   <script>
  $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();


  });
  </script>

</body>
</html>
