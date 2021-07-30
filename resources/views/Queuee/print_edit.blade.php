@extends('Admin')

@section('title','Imprimer')

@section('titlebig','Imprimer')

@section('titlesmall','Valeurs')

@section('content')


<form style="margin: 4%" method="POST" action="/print_edit">
				{{csrf_field()}}
  <div class="form-group">
    <label for="exampleInputEmail1">Logo</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="URL" placeholder="URL du Logo">
    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais vos informations.</small>
  </div>
  <br />
  <div class="form-group">
    <label for="exampleInputPassword1">Message</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="text" placeholder="Bienvenue chez...">
  </div>
  <br />
   <div class="form-group {{$errors->has('color')? 'has-error has-feedback' : ''}}">
						<label>Couleur des Services</label> 							
						<input  type="color" id="color" class="form-control " name="couleur" placeholder="Couleur" value="#ff6200"/>
					</div>
  
  <br />
  <button type="submit" class="btn btn-primary">Enregister</button>
</form>












@endsection