@extends('Admin')

@section('title','Clinique')

@section('titlebig','Clinique')

@section('titlesmall','Clinique_Liste')
<link href="{{asset('css/CliniqueStyle.css')}}" rel="stylesheet" />

@section('content')

<div class="container">
    <br>

     	<h3>Selectionner un Clinique Pour cette Client</h3>	
 	<div class="row" id="ads">
    <!-- Category Card -->
    <form method="POST" action="/save/{{$id}}">
	{{csrf_field()}}
	<input class="hidden" type="text" name="hotel" value="{{ app('request')->input('optradio') }}" />
    @foreach ($cliniques as $cliniq)

        <div class="col-md-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="/clinique/{{$cliniq->id}}">
                        <img class="pic-1" src="{{$cliniq->URL}}">
                    </a>
                    <span class="product-new-label">Sale</span>
                    <span class="product-discount-label">{{$cliniq->year}}</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{{$cliniq->titre}}</a></h3>
                    <div class="price">${{$cliniq->prix}}
             		</div>
                    <a class="add-to-cart" href="#">{{$cliniq->description}}</a><br />
                    <label><input type="radio" name="optradioCli" value="{{$cliniq->id}}"></label>

                </div>
            </div>
        </div>
        @endforeach
        <div class="form-group">
						<button type="submit" class="btn btn-primary">Save</button>
						 
					</div>		
</form>
</div>
</div>
@endsection