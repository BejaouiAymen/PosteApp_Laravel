@extends('Admin')

@section('title','List des Clients')

@section('titlebig','Clients')

@section('titlesmall','Client_List')

@section('content')
<br />
<a href="/clien/list">Completed Clients</a>
<br />
<br />
<br />
@if($titre=="")
<h3>Clients waiting for traitement!</h3>

<div class="row">
	@foreach($list as $k)
			<div class="col-md-4">
			<div class="card" style="width: 18rem;">
			<a class="block-link" href="/client/{{$k->id}}">
			  <img class="card-img-top" src="{{$k->URL}}" alt="Card image cap">
			  <div class="card-body">
			    <center><h5 class="card-title">{{$k->nom_prenom}}</h5></center></a>
			    <p class="card-text"><a href="/client_delete/{{$k->id}}"> <center><i data-toggle="tooltip" data-placement="bottom" title="Clicker Pour Supprimer!" class="fa fa-trash-o"></i></center></a>
			    	 </p>
			  </div>
			  			<a class="block-link" href="/client/{{$k->id}}">

			  <ul class="list-group list-group-flush">
			    <center><li class="list-group-item">{{$k->email}}</li></center>
			    <li class="list-group-item">{{$k->description}}</li>
			    <li class="list-group-item"><i class="fa fa-phone"></i> &nbsp;   {{$k->telephone}}</li>
			  </ul>
			</a>

			</div>
		</div>
	@endforeach
@else
<p>{{$titre}}</p>
@endif
</div>
@endsection