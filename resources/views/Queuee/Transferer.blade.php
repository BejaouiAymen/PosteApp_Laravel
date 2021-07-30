@extends('Admin')

@section('title','New Chirurgien')

@section('titlebig','Chirurgien')

@section('titlesmall','New_Chirurgien')
@section('content')

<form method="POST" action="/transferer/{{$id}}">
{{csrf_field()}}
<fieldset class="border p-2">

<h4> <strong> Tasks available :</strong></h4>
					@foreach($specialites as $specialite)
					<label class="container">
					  <input type="radio" name="ids[]" value="{{$specialite->id}}">
					  <span class="radio-inline"><b> {{$specialite->specialite}}</b></span>
					</label>
					@endforeach
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Ajouter</button>
						 
					</div>					
</fieldset>
</form>

@endsection