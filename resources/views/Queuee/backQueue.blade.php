@extends('Admin')

@section('title','Console d Appel')

@section('titlebig','Services')

@section('titlesmall','Notre services')


@section('content')
<div  style="display: inline-flex; display: flex;">
<div style="width: 70%">
<form id="myForm" method="POST" action="/affichage/">
				{{csrf_field()}}
					<?php $test=0 ?>
	@if(sizeof($client)!=0)
      				<?php $test=1;?>
    @endif
<table style="width: 700px" class="table-info table-bordered    table">    
<tbody>      					
@foreach($tasks as  $task)
 <tr> <th style="text-align: center;font-size: 20px"> {{$task->specialite}}
 </th>
	<th style="text-align: center;font-size: 20px">	{{$task->compteur}} 
   		</th>	
      		
			

</tr><br />

@endforeach
</tbody>
</table>
<button style="float: left" type="button" {{($test==0) ? 'disabled data-toggle="tooltip" data-placement="bottom" title=Pas_des_Clients' :''}}  class="btn btn-{{($test==0) ? 'warning' : 'success'}} " onclick="myFunction_add()"><h4> <b>Suivant</b> </h4></button>
@if($client->first())
<button style="float: left" type="button" class="btn btn-warning " onclick="window.location.href = '/transferer/{{$client->first()->id}}';"><h4> <b>Transferer</b> </h4></button>
<button style="float: left" type="button" class="btn btn-warning " onclick="window.location.href = '/rappel/{{$client->first()->id}}';"><h4> <b>Rappel</b> </h4></button>

@endif
</form>
</div>
<div style="width: 30%"> <table class="table table-striped">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Waiting_Date</th>
        <th>Domaine</th>
      </tr>
    </thead>
    <tbody>
           	@foreach($client as $k)
      		@foreach($tasks as $k1)
      			@if($k->task_id==$k1->id)
      			 <tr>
				        <td>{{$k->first}}</td>
				        <td>{{$k->created_at->diffForHumans()}}</td>
				        <td>{{$k1->specialite}}</td>
        		     </tr>
        		@endif
        	@endforeach
        @endforeach
     
      </tbody>
      </table>
       </div>
       
       </div>
<h1  id="demo" style="text-align: center;">
            
            </h1>

	<script>
	setTimeout(function() {
    location.reload();
},
@if($test==0)
 5000
@else
	15000
@endif
 );
</script>      
<script>
  
 function myFunction_transfere(){
 	  document.getElementById("myForm2").submit();
 }

function myFunction_add() {

  document.getElementById("myForm").submit();
}
function myFunction_dec(y) {
if(y==0){
	x=parseInt( document.getElementById("tache1").value);
	document.getElementById("tache1").value = x-1;
}
if(y==1){
	x=parseInt( document.getElementById("tache2").value);
	document.getElementById("tache2").value = x-1;
}
if(y==2){
	x=parseInt( document.getElementById("tache3").value);
	document.getElementById("tache3").value = x-1;
}
  document.getElementById("myForm").submit();

}
</script>

@endsection
