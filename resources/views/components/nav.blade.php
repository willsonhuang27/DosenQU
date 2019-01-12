
<script type="text/javascript" src={{asset("js/components/navbar.js")}}></script>

<div class="container-fluid bg-dark nav-component px-5">
	@if(session('role', 'guess') == 'guess')
	<div class="row">
		<a class="center offset-lg-1 col-lg-1 text-light" href={{url('/')}}>DosenQU</a>
		<a class="center offset-lg-7 col-lg-1 text-light" href={{url('login')}}>Login</a>
		<a class="center col-lg-1 text-light" href={{url('register')}}>Register</a>
	</div>
	@elseif(session('role', 'guess') == 'admin')
	<div class="row">
		<a class="center offset-lg-1 col-lg-1 text-light" href={{url('admin/')}}>DosenQU</a>
		<a class="center col-lg-1 text-light" href={{url('admin/myforum')}}>My Forum</a>
		<a class="center col-lg-1 text-light" href={{url('msuser')}}>Master User</a>
		<a class="center col-lg-1 text-light" href={{url('msthread')}}>Master Forum</a>
		<a class="center col-lg-1 text-light" href={{url('mscategory')}}>Master Category</a>
		<a class="text-right col-lg-3 text-light " href={{url('admin/profile/'.session('user_id'))}}><img style="border-radius: 50%; width: 25px; height: 25px;" src="{{URL::asset(session('profile_picture'))}}"> {{session('name')}}</a>
		<a class="center col-lg-1 text-light" href={{url('admin/inbox')}}>Inbox</a>
		<a class="center col-lg-1 text-light" href={{url('logout')}}>Logout</a>
	</div>
	@elseif(session('role', 'guess') == 'member')
	<div class="row">
		<a class="center offset-lg-1 col-lg-1 text-light" href={{url('member/')}}>DosenQU</a>
		<a class="center col-lg-1 text-light" href={{url('member/myforum')}}>My Forum</a>
		<a class="text-right offset-lg-3 col-lg-3 text-light " href={{url('member/profile/'.session('user_id'))}}><img style="border-radius: 50%; width: 25px; height: 25px;" src="{{URL::asset(session('profile_picture'))}}"> {{session('name')}}</a>
		<a class="center col-lg-1 text-light" href={{url('member/inbox')}}>Inbox</a>
		<a class="center col-lg-1 text-light" href={{url('logout')}}>Logout</a>
	</div>
	@endif
	<div class="row py-1">
		<div id="time" class="offset-lg-9 col-lg-2 center">

		</div>
	</div>
</div>