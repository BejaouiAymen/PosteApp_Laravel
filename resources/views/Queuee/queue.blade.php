<!DOCTYPE html>
<html>
	<title>KS-Tech Affichage</title>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial;
  padding: 10px;
  background: #f1f1f1;
}

/* Header/Blog Title */
.header {
  padding: 30px;
  text-align: center;
  background: white;
}

.header h1 {
  font-size: 50px;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Create two unequal columns that floats next to each other */
/* Left column */
.leftcolumn {   
  float: left;
  width: 50%;
}

/* Right column */
.rightcolumn {
  float: left;
  width: 50%;
  background-color: #f1f1f1;
  padding-left: 20px;
}

/* Fake image */
.fakeimg {
  background-color: rgba(170, 170, 170, 0);
  width: 100%;
  padding: 20px;
}

/* Add a card effect for articles */
.card {
  background-color: white;
  padding: 20px;
  margin-top: 20px;
  resize: both;
  overflow: auto;

}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}
.table-responsive{
            overflow-y: auto;
            border:2px solid #444;
          }
          
.table-wrapper-scroll-y {
display: block;
}
.table{
 background: #ff7900!important;
  color: white !important;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {
  .leftcolumn, .rightcolumn {   
    width: 100%;
    padding: 0;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .topnav a {
    float: none;
    width: 100%;
  }
}

h1{
	     height: 100%;
    padding: 0;
    margin: 0;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    align-items: center;
    justify-content: center;
}


</style>
</head>



<body onload="openFullscreen();">

<button  onclick="openFullscreen();">Open Fullscreen</button>
<script>

//alert('ok');

var elem = document.documentElement;
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}


</script>
<div class="topnav">
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#">Link</a>
  <a href="#" style="float:right" id="txt"></a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
    	<iframe width="100%" height="500px"
src="https://www.youtube.com/embed/6gb-B-ExQ1M?playlist=kRzAuMdonao&loop=1&autoplay=1&controls=0&mute=1">
</iframe>
      
      <p style="color: transparent;">Some text..</p>
      <p style="color: transparent;">Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    
  </div>
  <div class="rightcolumn">
      <div class="card" >
        <div class="row table-responsive table-wrapper-scroll-y my-custom-scrollbar" style="height: 470px" >
         
       @foreach($task as $k)
          <!--resize: both;overflow: auto;-->
          <div style="background-color: orange;" > 
            <h1 id="2" style="text-align: center;">
              {{$k->specialite}}
            </h1>
            <h1 style="text-align: center;">N°{{$k->compteur+1}}</h1>
          </div>
             <br>
      	@endforeach
        </div> 
        <script> var $el = $(".table-responsive");
        function anim() {
          var st = $el.scrollTop();
          var sb = $el.prop("scrollHeight")-$el.innerHeight();
          $el.animate({scrollTop: st<sb/2 ? sb : 0}, 5000, anim);
        }
        function stop(){
          $el.stop();
        }
        anim();
</script>    
      </div>
    </div>
  </div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" id="titre" style="text-align: center"></h3>
        </div>
        <div  class="modal-body">
			<table class="table" border="1" height="400px">
			    <thead>
			      <tr>
			        <th style="text-align: center"><h1> Guicher</h1></th>
			        <th style="text-align: center"><h1>Numéro</h1></th>
			      </tr>
			    </thead>
			   <br />
			    <tbody>
			      <tr>
			        <td style="text-align: center"><h1 id="guichier"></h1></td>
			        <td style="text-align: center"><h1 id="num"></h1></td>
			      </tr>
			    </tbody>
			  </table>          

        </div>
        
      </div>
    </div>
  </div>
  
<div class="footer">
  <h2>Footer</h2>
</div>
<script type="text/javascript">

  function startTime()
  {
  

  	
  	
  var today=new Date();
  var h=today.getHours();
  var m=today.getMinutes();
  var s=today.getSeconds();
  // add a zero in front of numbers<10
  m=checkTime(m);
  s=checkTime(s);
  document.getElementById('txt').innerHTML=h+":"+m+":"+s;
  t=setTimeout('startTime()',500);
  }
  function checkTime(i)
  {
  if (i<10)
  {
  i="0" + i;
  }
  return i;
  }
var k1={{$count}};
function kkk() {

   $.ajax({
   	
                type:'get',
                url:"{!!URL::to('affichage/"+k1+"')!!}",
                data:{'id':'mainID'},
                success:function(response){
                	k1=response[1];
                	$('#myModal').modal('show');
                	 $("#guichier").html(response[2].user_id);
                	 $("#titre").html(response[0].specialite);
                	 k=response[0].compteur+1;
                	 $("#num").html(k);
                	 $("#msg_vocal").html(": ticket numero"+k+". guicher "+response[2].user_id );
                	document.getElementById("play").click();
                	 
                	 setTimeout(function () {
  						 $('#myModal').modal('hide');
  						 setTimeout(function() {
    location.reload();
},1000);
                    }, 5000);

                    console.log(response[0].task_id);
                    //console.log(data);
                    // console.log(data.length);
                },
                error:function(){
                    
                }
            });
 	setTimeout(kkk,5000);
 }
  $(document).ready(function(){
 setTimeout(kkk,5000);
});     
  </script>


<div>
		<button id="play"></button> &nbsp;
		<button id="pause"></button> &nbsp;
		<button id="stop"></button> &nbsp;
</div>
<script>
		onload = function() {
			if ('speechSynthesis' in window) with(speechSynthesis) {
		
				var playEle = document.querySelector('#play');
				var pauseEle = document.querySelector('#pause');
				var stopEle = document.querySelector('#stop');
				var flag = false;
		
			
				playEle.addEventListener('click', onClickPlay);
				pauseEle.addEventListener('click', onClickPause);
				stopEle.addEventListener('click', onClickStop);
		
				function onClickPlay() {
					if(!flag){
						flag = true;
						utterance = new SpeechSynthesisUtterance(document.querySelector('article').textContent);
						utterance.voice = getVoices()[0];
						utterance.onend = function(){
							flag = false; playEle.className = pauseEle.className = ''; stopEle.className = 'stopped';
						};
						playEle.className = 'played';
						stopEle.className = '';
						speak(utterance);
					}
					 if (paused) { /* unpause/resume narration */
						playEle.className = 'played';
						pauseEle.className = '';
						resume();
					}
				}
		
			}
		
			else { /* speech synthesis not supported */
				msg = document.createElement('h5');
				msg.textContent = "Detected no support for Speech Synthesis";
				msg.style.textAlign = 'center';
				msg.style.backgroundColor = 'red';
				msg.style.color = 'white';
				msg.style.marginTop = msg.style.marginBottom = 0;
				document.body.insertBefore(msg, document.querySelector('div'));
			}
		
		}
		
		
			</script>
	<article>
		<h1 id="msg_vocal"></h1>
	
	</article>







</body>
</html>
