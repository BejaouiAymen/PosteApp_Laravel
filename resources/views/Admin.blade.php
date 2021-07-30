<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
<link href="{{asset('css/ProductStyle.css')}}" rel="stylesheet" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- Tell the browser to be responsive to screen width -->
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header" style="background-color: #ff8c00">
    <!-- Logo -->
    <a href="index2.html" class="logo" style="background-color: orange">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>KS</b>Tech</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KS Tech </b>Queue</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #ff8c00">
      <!-- Sidebar toggle button-->
      <a align="left" href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      	          
        <span class="sr-only">Toggle navigation</span>

      </a>
     
      <p>                                                                      	                                                                       </p>
      
      <div class="nav navbar-custom-menu">
        <ul class="nav">
          <!-- Messages: style can be found in dropdown.less-->
           	@if(auth()->user()->profile)
            	@if(\App\Helpers\Apphelper::instance()->usernumber()>=2)
			<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php $x=\App\Helpers\Apphelper::instance()->lastMessage();
              										echo (sizeof($x));
              										?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have {{sizeof(\App\Helpers\Apphelper::instance()->lastMessage())}} messages</li>
              <li>
      	          @foreach(\App\Helpers\Apphelper::instance()->lastMessage() as $k)

                <!-- inner menu: contains the actual data -->
                  <li ><!-- start message -->
                  	@foreach(\App\Helpers\Apphelper::instance()->contactedUser() as $users)
                    		@foreach($users as $k2)
                    	<p></p>
                    		<a href="/messages/{{$k2->id}}">
		                    	@if(($k2->id==$k->received_id)||($k2->id==$k->user_id))
		                        <img src="{{$k2->profile->URL}}" class="img-circle" height="80" width="80">
		                      <h4 style="color: black">
		                        {{$k2->name}}
		                        <small><i class="fa fa-clock-o">	 {{$k->created_at->diffForHumans() }}</i></small>
		                      </h4>
		                      <p  class="text-primary">{{$k->body}}</p>
		                    </a>
		                    	@endif
		                     @endforeach
		       		 @endforeach 
		       	
                  </li>
                  @endforeach
                  <!-- end message -->
              </li>
              <li class="footer"><a href="/messages/{{auth()->user()->id}}">See All Messages</a></li>
            </ul>
          </li>@endif
                      @endif

          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">{{auth()->user()->unreadnotifications->count()}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">	You have {{auth()->user()->unreadnotifications->count()}} notifications</li>
              <li class="menu-open">
                <!-- inner menu: contains the actual data -->
                 @foreach (auth()->user()->notifications->take(7) as $notification)
                  <li style="font-size:15px; {{($notification->read_at==null)? 'background-color:lightgray' :'background-color:white'}}">
                    <a href="/notificationRead/{{$notification->id}}">
                    <h5>  @if ($notification->data['type']=="ajout")
	                      <i class="fa fa-hotel"></i> 
	                      	@elseif ($notification->data['type']=="suppression")
	                       <i class="fa fa-trash"></i> 
	                     	 @else ($notification->data['type']=="modification")
	                       <i class="fa fa-list"></i> 
                      @endif
                    {{$notification->data['data']}}
                    @if(($notification->created_at->diffInHours(Carbon\Carbon::now(), false)<1))
                    <small>&nbsp;<i class="fa fa-clock-o"></i>&nbsp;{{$notification->created_at->diffForHumans()}}</small>
					
                    @elseif($notification->created_at->diffInHours(Carbon\Carbon::now(), false)<24)
                         <small>&nbsp;<i class="fa fa-clock-o"></i> &nbsp;{{$notification->created_at->diffInHours(Carbon\Carbon::now(), false)}} Heures</small>
					
					@elseif(($notification->created_at->diffInDays(Carbon\Carbon::now(), false)<7))
                    <small>&nbsp;<i class="fa fa-clock-o"></i>&nbsp;{{$notification->created_at->diffInDays(Carbon\Carbon::now(), false)}} Jours</small>
					@else($notification->created_at->diffInDays(Carbon\Carbon::now(), false)>7))
					 <small>&nbsp;<i class="fa fa-clock-o"></i>&nbsp;{{$notification->created_at->diffInWeeks(Carbon\Carbon::now(), false)}} Week/s</small>

					@endif

                    </h5></a>
                  </li>
                  @endforeach
              </li>
              <li class="footer"><a href="/notificationlist">View all</a></li>
            </ul>
          </li>
          
          <!-- User Account: style can be found in dropdown.less -->
          <ul class="nav">
       @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} 
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/logoutt/"
                                           >
                                            Logout
                                        </a>

                                      
                                    </li>
                                    <!-- <li>
                                        <a href="#"
                                           onclick="tick(1);">
                                            Reunion <p id="time1"></p><a href="#" onclick="redirect(1)"  style="display: none" id="Done1">Reunion Terminer</a>
                                        </a>

                                    </li>
                                    <li>
                                        <a href="#"
                                          	onclick="tick(2);">
                                            Pause <span id="time2"></span><a href="#" onclick="redirect(2)" style="display: none"  id="Done2">Pause Terminer</a>
                                        </a>

                                    </li> -->
                                </ul>
                            </li>
                        @endif
                        </ul>
                        
           <script>
            var timeElapsed = 0;
            var min=0;
            function tick(y) {
            	x=y;
                timeElapsed++
                if(timeElapsed>59){
                	timeElapsed=0;
                	min++
                }
                if(y==1){
                document.getElementById("time1").innerHTML =": min:"+min+ " sec:"+ timeElapsed;
                document.getElementById("Done1").style.display="block";
                }
                else{
                	document.getElementById("time2").innerHTML =": min:"+min+ " sec:"+ timeElapsed;
                	document.getElementById("Done2").style.display="block";

                
                }
                  t=setTimeout('tick(x)',1000);

            }
			function redirect(y){
				x=0;
				while(min!=0){
					x=x+60;
					min=min-1;
				}
				x=x+timeElapsed;
				if(y==1){
				window.location.href = "/reunion/"+x;
				}else{
				window.location.href = "/pause/"+x;
				}
				
			}
            
        </script>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        @if(auth()->user()->profile)
          
        	<img  src="http://ds-tv.ml/wp-content/uploads/2020/03/cropped-download_20200310_003037-e1583882620369-1.png?i=1" width="120" height="110"  class="img-thumbnail" alt="User Image">
        @else
        <!-- do nothing -->
        @endif
        <div class="pull-right">
        	      		<p style="color: white">   {{ Auth::user()->name }} </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Principale</li>
         
                <li><a href="/admin/create"><i class="fa fa-globe"></i> <span>Profil</span></a></li>

                       <li><a href="/admin"><i class="fa fa-users"></i> <span>Team</span></a></li>

        <li>
          <a href="/console_d_appel">
            <i class="fa fa-th"></i> <span>Service d'Appel</span>
            </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i  class="fa fa-bar-chart"></i>
            <span>Stat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/stats/"><i class="fa fa-area-chart"></i> Stats</a></li>
            <li><a href="/everstats/"><i class="fa fa-line-chart"></i> All Stats</a></li>

           <!-- <li><a href="/list"><i class="fa fa-pencil-square-o"></i> Modify</a></li>
            <li><a href="/hotel/create"><i class="fa fa-plus"></i> Add</a></li>
            <li><a href="/listDelete"><i class="fa fa-trash-o"></i> Delete</a></li>
          --></ul>
        </li>
        <!--<li class="treeview">
          <a href="#">
            <i  class="fa fa-hospital-o"></i>
            <span>......</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/clinique"><i class="fa fa-h-square"></i> ........</a></li>
            <li><a href="/clinique/create"><i class="fa fa-plus"></i> Add</a></li>
            <li><a href="/clin/list"><i class="fa fa-list"></i> All Cliniques</a></li>
          </ul>
         
        </li>
         -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-ticket" aria-hidden="true"></i>

            <span>Tickets</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="/print_edit"><i class="fa  fa-print" aria-hidden="true"></i>Imprimer</a></li>
           <li><a href="/service"><i class="fa fa-pencil"></i> Modifier Service</a></li>
            <!--<li><a href="/chirurgien/create"><i class="fa fa-plus"></i> Give Tasks</a></li> 
            --><li><a href="/specialite"><i class="fa fa-plus" aria-hidden="true"></i>Ajout Service</a></li>
            </ul>
        </li>
                   <li><a href="/chirurgien"><i class="fa fa-tasks"></i> Les Service</a></li>

        <li>
          <a href="#">
            <i class="fa fa-desktop"></i> <span>Affichage</span>
            </a>
        </li>
        @if(auth()->user()->id==1)
        <li class="treeview">
          <a href="#">
            <i  class="fa fa-user-circle"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>  
          <ul class="treeview-menu">
            <li><a href="/register"><i class="fa fa-user-plus"></i> Add</a></li>
            <li><a href="/administrateur/userlist"><i class="fa fa-trash-o"></i> Delete</a></li> 
            </ul>
        </li>
           @endif
        
		@if(auth()->user()->profile)
            @if(\App\Helpers\Apphelper::instance()->usernumber()>=2)
	        <li>
	          <a href="/messages/{{auth()->user()->id}}">
	            <i class="fa fa-envelope"></i> <span>Mailbox</span>
	            <span class="pull-right-container">
	              <small class="label pull-right bg-yellow"> {{sizeof(\App\Helpers\Apphelper::instance()->lastMessage())}}</small>
	              <small class="label pull-right bg-green">@yield('messagesend')</small>
	              <small class="label pull-right bg-red">@yield('messagereceived')</small>
	            </span>
	          </a>
	        </li>
        	@endif
        @endif
               <li><a href="#"><i class="fa fa-window-restore"></i> <span>About Us</span></a></li>

         <li class="header">LABELS</li>
       
        	 <li>
                                        <a href="/logoutt/">
                                           
                                                     <i class="fa fa-circle-o text-red"></i>
                                            Logout
                                        </a>

                                       
                                    </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('titlebig')
        <small>@yield('titlesmall')</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/console_d_appel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('titlebig')</li>
      </ol>
      @yield('content')

      
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>



</body>
</html>