@extends('Admin')

@section('title',' Admins_List')

@section('titlebig','Administrateur')

@section('titlesmall','Admins_Liste')

	<meta name="viewport" content="width=device-width, initial-scale=1">
	
@section('content')
    
<br />

<table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
         <th><center> Email</center></th>
        <th><center> Supprimer</center></th>

      </tr>
    </thead>

@foreach ($users as $us)
 
    <tbody  id="myTable">
      <tr>
        <td><center>{{$us->email}} <?php if($us->id==auth()->user()->id) echo "(votre Email)"; ?></center></td>
        <td><center> 
        	@if(auth()->user()->id==$us->id)
        		<p style="color: grey">Supprimer</p>
			@else
			<form method="POST" action="/admin/{{$us->id}}">
					{{method_field('DELETE')}}
					{{csrf_field()}}	
		        	<center><button type="submit" class="btn btn-danger" >Supprimer</button>
							</center>
			</form>
        	@endif
        </center></td>

      </tr>
	</tbody>
@endforeach

</table>

@endsection
