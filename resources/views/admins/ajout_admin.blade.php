@extends('Admin')

@section('title','New Administrateur')
@section('titlebig','Administrateur')

@section('titlesmall','Add a New Admin')
@section('content')
    
<div class="container">
			        
				        
	<div class="row" >
		<div class="col-md-10 offset-1">
			<form method="POST" action="/admin">
				{{csrf_field()}}
				<h2>Vous n'avez pas de profil ... pourquoi n'en créez-vous pas!</h2>
				<fieldset class="border p-2">
   				<legend  class="w-auto">Profile</legend>
					<div class="form-group {{$errors->has('nom')? 'has-error has-feedback' : ''}}">
						<label>Nom</label>
						<input type="text" class="form-control " name="nom" placeholder="Votre Nom" value="{{ old('nom')}}"/>
					</div>
					<div class="form-group {{$errors->has('prenom')? 'has-error has-feedback' : ''}}">
						<label>Prenom</label>
						<input type="text" class="form-control " name="prenom" placeholder="Votre Prenom" value="{{ old('prenom')}}"/>
					</div>
					
					<div style="display: none" class="form-group {{$errors->has('smalldescription')? 'has-error has-feedback' : ''}}">
						<label>SmallDescription</label>
						<input type="text" class="form-control" name="smalldescription" placeholder="why do you want this POSTE...use little details.. " value=" &nbsp; &nbsp; &nbsp;"/>
					</div>
					<div style="display: none"  class="form-group {{$errors->has('fulldescription')? 'has-error has-feedback' : ''}}">
						<label>FullDescription</label>
						<input type="text" class="form-control" name="fulldescription" placeholder="why do you want this POSTE...In Full details.. " value=" &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; "/>
					</div>
					<div style="display: none" class="form-group {{$errors->has('age')? 'has-error has-feedback' : ''}}">
						<label>Age</label>
						<input type="text" class="form-control" name="age" placeholder="Votre age" value="25"/>
					</div>
					<label>Sexe:</label>
					<div style="margin-left: 3%" class="radio">
						  <label><input type="radio" name="sexe" value="https://www.w3schools.com/howto/img_avatar.png" checked>Homme</label>
						</div>
						<div style="margin-left: 3%" class="radio">
						  <label><input type="radio" name="sexe" value="https://www.w3schools.com/w3images/avatar5.png">Femme</label>
						</div>
						<br />
					<input style="display: none" name="id" type="text" value="{{$id}}" />
					<div class="form-group {{$errors->has('email')? 'has-error has-feedback' : ''}}">
						<label>Email</label>
						<input type="email" class="form-control" name="email" placeholder="Saisir votre Email" value="{{ old('email')}}"/>
					</div>	
					<div class="form-group {{$errors->has('telephone')? 'has-error has-feedback' : ''}}">
						<label>telephone</label>
						<input type="text" class="form-control" name="telephone" placeholder="Saisir votre Telephone" value="{{ old('telephone')}}"/>
					</div>	
					
					<br />
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Ajouter</button>
						 
					</div>					
				</fieldset>
				@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
						<li>
							{{$error}}
						</li>
						@endforeach
					</ul>	
				</div>
				@endif
			</form>
		</div>	
	
	


</div>
</div>
		  
@endsection
