<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Ready Bootstrap Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="{{ asset('assets/backend/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<!-- summernote -->
	<link rel="stylesheet" href="{{ asset('assets/backend/summernote/summernote-lite.min.css') }}">

	<!-- dropify -->
	<link rel="stylesheet" href="{{ asset('assets/backend/dropify/css/dropify.min.css') }}">

	<!-- tags -->
	<link rel="stylesheet" href="{{ asset('assets/backend/tags/bootstrap-tagsinput.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/backend/css/ready.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.html" class="logo">
					Ready Dashboard
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					
					<form class="navbar-left navbar-form nav-search mr-md-3" method="get" action="">
						<div class="input-group">
							<input type="search" name="query" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="{{ asset('assets/backend/img/profile.jpg') }}" alt="user-img" width="36" class="img-circle"><span >Hizrian</span> </a>
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="{{ asset('assets/backend/img/profile.jpg') }}" alt="user"></div>
										<div class="u-text">
											<h4>Hizrian</h4>
											<p class="text-muted">hello@themekita.com</p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-settings"></i> Account Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="{{ route('logout') }}"
									onclick="event.preventDefault();
									document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
									<form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
										@csrf
									</form>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="{{ asset('assets/backend/img/profile.jpg') }}">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									Hizrian
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item {{ Route::is('admin.home') ?  'active' : ''}}">
							<a href="{{ route('admin.home')}}">
								<i class="la la-dashboard"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('admin.category.*') ?  'active' : ''}}">
							<a href="{{ route('admin.category.index')}}">
								<i class="la la-table"></i>
								<p>Category</p>
							</a>
						</li>					
						<li class="nav-item {{ Route::is('admin.blog.index') ?  'active' : ''}}">
							<a href="{{ route('admin.blog.index')}}">
								<i class="la la-table"></i>
								<p>Blog</p>
							</a>
						</li>			
						<li class="nav-item {{ Route::is('admin.blog.create') ?  'active' : ''}}">
							<a href="{{ route('admin.blog.create')}}">
								<i class="la la-table"></i>
								<p>Add Blog</p>
							</a>
						</li>
						<li class="nav-item {{ Route::is('admin.comment.index') ?  'active' : ''}}">
							<a href="{{ route('admin.comment.index')}}">
								<i class="la la-table"></i>
								<p>Comment</p>
								@php
								$comments = \App\Models\Comment::where('p_id',0)->where('is_read',0)->count();

								@endphp
								<span class="badge badge-success">{{ $comments }}</span>
							</a>
						</li>

						<li class="nav-item {{ Route::is('admin.notification.index') ?  'active' : ''}}">
							<a href="{{ route('admin.notification.index')}}">
								<i class="la la-table"></i>
								<p>Notification</p>
								<span class="badge badge-success">{{ Auth::user()->unreadNotifications->count() }}</span>
							</a>
						</li> 
					</ul>
				</div>
			</div>
			<!-- body -->
			@yield('content')
			<!-- end content body -->
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="{{ asset('assets/backend/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/chartist/chartist.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/jquery-mapael/jquery.mapael.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/jquery-mapael/maps/world_countries.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/chart-circle/circles.min.js') }}"></script>
	<script src="{{ asset('assets/backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

	<!-- summernote -->
	<script src="{{ asset('assets/backend/summernote/summernote-lite.min.js') }}"></script>

	<!-- dropify -->
	<script src="{{ asset('assets/backend/dropify/js/dropify.min.js') }}"></script>
	<!-- tags -->
	<script src="{{ asset('assets/backend/tags/bootstrap-tagsinput.js') }}"></script>

	@yield('script')
	<!-- custom them -->
	<script src="{{ asset('assets/backend/js/ready.min.js') }}"></script>
	</html>