@extends('Admin')

@section('title','Clients Resultat')

@section('titlebig','Clients')

@section('titlesmall',$client->nom_prenom)
<link href="{{asset('css/CliniqueStyle.css')}}" rel="stylesheet" />


@section('content')

<div class="container">
    <br>
	<br>

	<h3>Bonjour mr/mm <strong> {{$client->nom_prenom}}</strong><br /> nous avons vous accepter
		 sur notre sociéte...ici des information sur les hotels, cliniques et les chirurgiens</h3>
	<br />	
	<div class="row" id="ads">
	

<div class="col-md-4">
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
    <div class="col-md-4 col-sm-6">
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
   </div> 
</div>
@endsection