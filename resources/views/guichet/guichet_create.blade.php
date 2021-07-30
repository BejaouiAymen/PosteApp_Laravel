@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Num Guichet</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/guichet">
                        {{ csrf_field() }}

                        
                        <div class="form-group">
                        	                           
						  <label class="col-md-4 control-label" for="sel1">Guichet list:</label>
						    <div class="col-md-6">
						  <select class="form-control" id="sel1" name="guichet">
						  	@for ($i = 1; $i < 10; $i++)
						  <?php $x=0;?>
						  	@foreach($guichet as $k)
						  		@if($k->user_id==$i)
						  			<?php $x=1;?>
								@endif
							@endforeach
							@if($x==0)
								<option value="{{$i}}">{{$i}}</option>
								
							@endif
							@endfor
						   
						  </select>
						  </div>
						</div>
						<div class="form-group">
							 <div class="col-md-10">
						<button type="submit" style="float: right" class="btn btn-primary">Confirmer</button>
						 </div>
					</div>		
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
