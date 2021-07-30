<html>
  <head>
    <meta charset="utf-8">
    <title>KS-Tech Impression</title>
	<style>
		article {
  display: flex;
  height: 100%;
  flex-direction: column;
}

section {
  flex-grow: 1;
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

body {
  font-family: Helvetica, sans-serif;
  margin: 0;
  
}

.button {
  background-color: {{$print->couleur}}; /*#4CAF50;  Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button2 {width: 50%;height: 80%;}



	</style>
	
  </head>
  <body>
    <article>
    	
      <section style="display: inline-flex;">
      	<div style="width: 30%;padding: 1%">
			<img height="50%" width="100%" src="{{$print->URL}}" />
        </div>
      	<?php $i=1; ?>
      	      	<div style="width: 80%;">

      	@foreach($task as $k)
      	
        <div style="height: {{100/sizeof($task)}}%;" >
<h1> <button class="button button2" onclick="myFunction({{$k->id}})"><h2>  {{$k->specialite}}</h2></button><br>
</h1>
        </div>
       <?php $i++;?>
        @endforeach
        </div>
      </section>
    </article>
    <form id="myForm" method="POST" action="/print/">
				{{csrf_field()}}			
    <input style='display:none' type="text" name="text" id="text" value="">
	</form>
<script>
	function myFunction(x) {
	document.getElementById("text").value =x ;
	  document.getElementById("myForm").submit();

}
	function myFunctionB() {
	document.getElementById("text").value = "Copie Conforme";
	document.getElementById("number").value = "38";
  document.getElementById("myForm").submit();

}	
	function myFunctionC() {
	document.getElementById("text").value = "Taarif bel Emdha";
	document.getElementById("number").value = "64";
  document.getElementById("myForm").submit();
}	
</script>
    
  </body>
</html>