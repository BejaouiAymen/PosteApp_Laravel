@extends('Admin')

@section('title','New Administrateur')
@section('titlebig','Administrateur')

@section('titlesmall','Add a New Admin')
<link href="{{asset('css/MessageStyle.css')}}" rel="stylesheet" />

<!------ Include the above in your HEAD tag ---------->
<?php
	$x1=0;
	$x2=0;	
?>
@section('content')

<div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
            @foreach($distinctCaracters as $user)
            	@foreach($user as $k)
					@foreach($var as $x)
						@if($k->id==$x->user_id)
						<?php
							$x1++;
						?>
				            <div class=" chat_list active_chat ">
						@elseif($k->id==$x->received_id)
						<?php
							$x2++;
						?>
				
				            <div class=" chat_list  ">
						@endif
					@endforeach
                          	
              	<a class="block-link" href="/messages/{{$k->id}}">
						<div class="chat_people">
              	@if($k->profile)
              		
                <div class="chat_img"> <img src="{{$k->profile->URL}}" class="rounded-circle" alt="Cinque Terre" height="35"> </div>
                @else           	
                                 <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" > </div>
                @endif

                <div class="chat_ib">
                  <h5>{{$k->name}}
                  	@foreach($var as $x)
							@if(($k->id==$x->received_id)||($k->id==$x->user_id))
							  <span class="chat_date">{{$x->created_at->diffForHumans() }}</span></h5>
                  <p>
						{{$x->body}}
							</p>
                        @endif
						@endforeach
					
                </div>

              </div>
              </a>
            </div>
            @endforeach
               @endforeach		
            
          </div>
        </div>
        <div class="mesgs">
          <div class="msg_history" id="messageBody">
          	<center><h2> @foreach($distinctCaracters as $user)
            		@foreach($user as $k)
            			@if($k->id==$id)
            				{{$k->name}}
            			@endif
            		@endforeach
            	@endforeach
            </h2></center>
            <br />
            @if(auth()->user()->id==$id)
            <center><h3>Welcome MR/MM {{auth()->user()->name}}</h3></center>
            	<br />
            	<br />
            	<div class="incoming_msg">
              <div class="incoming_msg_img"> @if(auth()->user()->profile)<img src="{{auth()->user()->profile->URL}}" alt="sunil">@else <img src="https://ptetutorials.com/images/user-profile.png" >  @endif </div>
              <div class="received_msg">
                <div class="received_withd_msg">
	                <p>
						Wlecome to our systeme dmessagerie
						vous pouvez envoyer des messages a l'aide du ce systeme et recevoir des uns<br />
						Voici Quelles que Information :
						<br /><br />
						<small class="label bg-red">x</small> represente le nombre des contact que vous avez les envoyer les derniers messages..<br /><br />
						<small class="label bg-green">x</small> represente le nombre des contact qu'ils ont vous envoyer les derniers messages..<br /><br />
						<small class="label bg-yellow">x</small> represente le nombre des contact que vous avez les contacter..
					</p>
	                  <span class="time_date"> 11:01 AM    |    June 9</span></div>
              </div>
            </div>

           @else
            @foreach($distinctCaracters as $user)
            	@foreach($user as $k)
            	@foreach($requette as $k2)
            	@if($k2->received_id==auth()->user()->id)
					@if(($k->id==$k2->received_id)||($k->id==$k2->user_id))

            <div class="incoming_msg">
              <div class="incoming_msg_img"> @if($k->profile)<img src="{{$k->profile->URL}}" alt="sunil">@else <img src="https://ptetutorials.com/images/user-profile.png" >  @endif </div>
              <div class="received_msg">
                <div class="received_withd_msg">
	                <p>
						{{$k2->body}}
					</p>
	                  <span class="time_date">{{$k2->created_at->diffForHumans() }}</span></div>
              </div>
            </div>
				@endif

            @else
             	@if(($k->id==$k2->received_id)||($k->id==$k2->user_id))
            <div class="outgoing_msg">
              <div class="sent_msg">
                <p>
					{{$k2->body}}
				</p>
                <span class="time_date"> {{$k2->created_at->diffForHumans() }}</span> </div>
            </div>
            	@endif
            @endif
            @endforeach
             @endforeach
               @endforeach	
          @endif	
          </div>
          <form method="POST" action="/send_message/{{$id}}">
				{{csrf_field()}}
			
          <div class="type_msg">
            <div class="input_msg_write">
            @if(auth()->user()->id==$id)
			  <input type="text" name="body" class="write_msg" placeholder="You cant send a Message to yourself...Logique non?!" />
              <button class="msg_send_btn disabled" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            
			@else
              <input type="text" name="body" class="write_msg" placeholder="Type a message" />
              <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            @endif
            </div>
          </div>
        </form>  
        </div>
      </div>
      
      
      <p class="text-center top_spac"> Design by <a target="_blank" href="#">Sunil Rajput</a></p>
      
    </div></div>
    
    <script>
    	var messageBody = document.getElementById('messageBody');
		messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
    </script>
@section('messagesend',$x1)
@section('messagereceived',$x2)
    
@endsection
