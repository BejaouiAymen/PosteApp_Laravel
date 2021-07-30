@extends('Admin')

@section('title','Statistique')

@section('titlebig','Stats')

@section('titlesmall','Statistique')


@section('content')

<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2", // "light2", "dark1", "dark2"
	animationEnabled: true, // change to true		
	title:{
		text: "KS Tech STATS"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
		@foreach($stat as $key => $k)
			@foreach($profile as $k2)
				@if($key==$k2->id)
					{ label: "{{$k2->nom}} {{$k2->prenom}} ",  y: {{$k}}  },
				@endif
			@endforeach
		@endforeach
		
		]
	}
	]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<br />

@endsection