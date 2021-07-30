@extends('Admin')

@section('title','Client')

@section('titlebig','Clients')

@section('titlesmall','Client_Traité ')
<link href="{{asset('css/ChirurgienStyle.css')}}" rel="stylesheet" />
<link href="{{asset('css/CliniqueStyle.css')}}" rel="stylesheet" />


@section('content')

<div class="container">
    <br>
	<br>

@foreach($clients as $client)
	<h3>{{$client->nom_prenom}}</h3>
	<br />	
	<div class="row" id="ads">
	

<div class="col-md-3">
        <div class="card rounded">
            <div class="card-image">
                <span class="card-notify-badge">{{$client->hotel->titre}}</span>
                <span class="card-notify-year">{{$client->hotel->year}}</span>
                <img class="img-fluid" src="{{$client->hotel->URL}}"  width="445" height="250" alt="Alternate Text" />
            </div>
            <div class="card-image-overlay m-auto">
                <span class="card-detail-badge">Used</span>
                <span class="card-detail-badge">${{$client->hotel->prix}}</span>
                <span class="card-detail-badge">13000 Kms</span>
            </div>
            <div class="card-body text-center">
                <div class="ad-title m-auto">
                    <h6>{{$client->hotel->description}}</h6>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                        <img class="pic-1" src="{{$client->clinique->URL}}">
                    <span class="product-new-label">Sale</span>
                    <span class="product-discount-label">{{$client->clinique->year}}</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{$client->clinique->titre}}</a></h3>
                    <div class="price">${{$client->clinique->prix}}
             		</div>
                    <a class="add-to-cart" href="#">{{$client->clinique->description}}</a><br />

                </div>
            </div>
        </div>
        <h3>Liste des chirurgiens</h3>
        
        @if($chirurgiens)
        @foreach($chirurgiens as $chirur)
        	@if($chirur[0]->pivot->client_id==$client->id)
					<div class="col-md-3">
		    		    <div class="card profile-card-1">
		    		        <img src="https://images.pexels.com/photos/946351/pexels-photo-946351.jpeg?w=500&h=650&auto=compress&cs=tinysrgb" alt="profile-sample1" class="background"/>
		    		        <img src="{{ $chirur[0]->URL}}" width="45%" height="35%" alt="profile-image" class="profilee"/>
		                    <div class="card-contenttt">
		                    <h2><strong style="color: white">{{ $chirur[0]->fullname}}</strong>
		                    </h3>
		                    <div class="icon-block"><a href="#"><i  data-toggle="tooltip" data-placement="bottom" title="{{ $chirur[0]->telephone}}" class="fa fa-phone"></i></a><a href="#"> <i  data-toggle="tooltip" data-placement="bottom" title="Age est {{ $chirur[0]->age}}" class="fa fa-info"></i></a>
		                    	<a href="/chirurgien_delete/{{ $chirur[0]->id}}"> <i data-toggle="tooltip" data-placement="bottom" title="Clicker Pour Supprimer!" class="fa fa-trash-o"></i></a></div>
		                    </div>
		                </div>
		                <p class="mt-3 w-100 float-left text-center"><strong>Basic Profile Card</strong></p>
	    		</div> 	
	    		@endif
        @endforeach
        @endif
        
                <a href="/clien_chirurgien/{{$client->id}}"><p>Ajouter des chirurgiens</p></a>

   </div> 
@endforeach
</div>
@endsection