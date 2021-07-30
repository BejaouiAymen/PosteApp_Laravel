@extends('Admin')

@section('title','Liste Chirurgiens')

@section('titlebig','Chirurgien')

@section('titlesmall','Chirurgien_List')
<link href="{{asset('css/ChirurgienStyle.css')}}" rel="stylesheet" />

@section('content')
    <div class="container">
    	<br />
    	<br />
   	<form method="POST" action="/clien_chirurgien_save/{{$id}}">
	{{csrf_field()}}
    
		@foreach($chirurgiens as $chirurgien)
				<div class="col-md-4">
		    		    <div class="card profile-card-1">
		    		        <img src="https://images.pexels.com/photos/946351/pexels-photo-946351.jpeg?w=500&h=650&auto=compress&cs=tinysrgb" alt="profile-sample1" class="background"/>
		    		        <img src="{{ $chirurgien->URL}}" width="45%" height="35%" alt="profile-image" class="profilee"/>
		                    <div class="card-contenttt">
		                    <h2><strong style="color: white">{{$chirurgien->fullname}}</strong>
		                    	@foreach($specialites as $specialite)
		                    		@if($specialite[1]==$chirurgien->id)
		                    			<small style="color: #CACACA">{{$specialite[0]}}</small>
		                    		@endif
		                    	@endforeach
		                    </h3>
		                    
		                    </div>
		                </div>
                       <center><label><input type="checkbox" name="ids[]" value="{{$chirurgien->id}}"></label>
						</center>
		                <p class="mt-3 w-100 float-left text-center"><strong>Profile Card du {{$chirurgien->fullname}}</strong></p>
	    		</div> 
		@endforeach
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Save</button>		 
		</div>		
	</form>
		</div>

@endsection