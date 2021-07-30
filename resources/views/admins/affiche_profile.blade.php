@extends('Admin')

@section('title','Profile')

@section('titlebig','Profile')

@section('titlesmall','Votre Profil')

@section('content')
<br /><br /><br />
	<div class="row">
		<div class="col-md-6 offset-1">
			<form>
				
				<fieldset class="border p-2">
   				<legend  class="w-auto">{{$profile->nom}} 's Profile</legend>
   						<div class=" offset-1">

							  <dl>
							    <dt>Nom :</dt>
							    <dd>- {{$profile->nom}}</dd>
							    
							    <dt>Prenom :</dt>
							    <dd>- {{$profile->prenom}}</dd>
							    
							    
							    <dt>Email :</dt>
							    <dd>- {{$profile->email}}</dd>
							   
							    <dt>Telephone Number :</dt>
							    <dd>- {{$profile->telephone}}</dd>
							 
							  </dl>     
 					 </div>
  					
					
				</fieldset>
			</form>
		</div>	
		<div class="col-md-5">						
			<div class="container">
			  <h2>{{$profile->nom}}'s Card</h2>
			  <p>Ceci est votre Model :</p>
			  <div class="card" style="width:300px">
			    <img class="card-img-top" src="{{$profile->URL}}" alt="Card image" style="width:100%">
			    <div class="card-body">
			     <center><p>{{$profile->email}}</p></center>
			      <h3 class="card-title">{{$profile->nom}} {{$profile->prenom}}</h3>
			      <p class="card-text">{{$profile->smalldescription}}</p>
			      <a href="/admin/{{auth()->user()->id}}/edit" class="btn btn-primary">Modifier Profile</a>
			    </div>
			  </div>
			 
			</div>

			
		</div>
	</div>
	
<div class="container">

  <!-- Modal -->
  
</div>
	
	
	
	
	

@endsection
