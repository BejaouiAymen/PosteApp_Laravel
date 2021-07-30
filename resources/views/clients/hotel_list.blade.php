
@extends('Admin')

@section('title','Clients_Hotels')

@section('titlebig','Hotel')

@section('titlesmall','Hotels_For_Clients')
@section('content')
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <br>
    <h3>Selectionner un hôtel pour {{$client->nom_prenom}}</h3>
	<br>
	<div class="row" id="ads">
    <!-- Category Card -->
	<form action="/clien/clinique/{{$id}}">
	    @foreach ($hotels as $us)
	    <div class="col-md-5">
	    	 <div class="card rounded">
	            <div class="card-image">
	                <span class="card-notify-badge">{{$us->titre}}</span>
	                <span class="card-notify-year">{{$us->year}}</span>
	                <img class="img-fluid" src="{{$us->URL}}"  width="445" height="250" alt="Alternate Text" />
	            </div>
	            <div class="card-image-overlay m-auto">
	                <span class="card-detail-badge">Used</span>
	                <span class="card-detail-badge">${{$us->prix}}</span>
	                <span class="card-detail-badge">13000 Kms</span>
	            </div>
	            <div class="card-body text-center">
	                <div class="ad-title m-auto">
	                    <h5>{{$us->description}}</h5>
	                </div>
	                <label><input type="radio" name="optradio" value="{{$us->id}}"></label>
			
				</div>
	            
	        </div>
	    </div>        @endforeach
	    	
	    	<button type="submit" class="btn btn-primary">Next Page</button>
	</form>
<br />
    <center><a href="hotel/create">ajout</a></center>

</div>
</div>

@endsection