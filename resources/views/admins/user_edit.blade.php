@extends('Admin')

@section('title','Modifier User')


@section('titlebig','Admin')

@section('titlesmall','Modification du profile')


@section('content')

<br /><br /><br />
	<div class="row">
		<div class="col-md-12 offset-0">
			<form method="POST" action="/admin/{{$admin->id}}">
				{{method_field('PATCH')}}
				{{csrf_field()}}
				<fieldset class="border p-2">
   				<legend  class="w-auto">Edit</legend>
					<div class="form-group">
						<label>Nom</label>
						<input type="text" class="form-control" name="nom" value="{{$admin->nom}}" />
					</div>
					<div class="form-group">
						<label>Prenom</label>
						<input type="text" class="form-control" name="prenom" value="{{$admin->prenom}}" />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" name="email" value="{{$admin->email}}"  />
					</div>
					<div style="display: none" class="form-group">
						<label>Votre Description</label>
						<input type="text" class="form-control" name="smalldescription" value="{{$admin->smalldescription}}"  />
					</div>
					<div style="display: none" class="form-group">
						<label>Votre Description detaillée</label>
						<input type="text" class="form-control" name="fulldescription" value="{{$admin->fulldescription}}"  />
					</div>
					<div style="display: none" class="form-group">
						<label>Votre Age</label>
						<input type="text" class="form-control" name="age" value="{{$admin->age}}"  />
					</div>					
					<div class="form-group">
						<label>Votre Image URL</label>
						<input type="text" class="form-control" name="image" value="{{$admin->URL}}"  />
					</div>
					
					
									
					<br />
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>



@endsection
