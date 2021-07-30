
<html>
  <head>
    <meta charset="utf-8">
    <title>KS-Tech 2020</title>
	<style>
	article {
  display: flex;
  height: 100%;
  flex-direction: column;
}

section {
  flex-grow: 1;
}
div{
	     height: 100%;
    padding: 0;
    margin: 0;
   
    display: -webkit-flex;
    display: flex;
    align-items: center;
    justify-content: center;
}

</style>
</head>
<body onload="window.print()">

	
							<img  src="{{$print->URL}}" height="50px" width="50px" />
<h5 style="float: right" id="demo"></h5> 		
	<h3 style="text-align: center">

		<br />
		{{$print->text}}<br />
<br />
		{{$task->specialite}}
		<br />
		Ticket N°{{$client->first}}
		<br /><br />
	</h3>		
		<h5 style="text-align: center">{{$num}} Clients en attente</h5>
<hr />
			<h5 style="text-align: center">Merci pour votre visite</h5>

	<script>
	var d = new Date(); // for now

document.getElementById("demo").innerHTML = d.getHours()+"h:"+d.getMinutes()+"m:"+d.getSeconds();
	
	
		setTimeout(function() {
     window.history.back();
}, 1000);
  
	</script>
	
</body>


</html>