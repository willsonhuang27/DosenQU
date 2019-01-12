@extends('components.master')

@section('title','Thread Forum')

@section('content')

	<div class="card mb-5">
		<div class="container card-header">
			<div class="row " style="padding: 0; padding: 10px;">
				<h4 class="col-lg-11 mb-0">{{$thread->name}}</h4>
				@if($thread->status == 0)
					<span class="col-lg-1 badge badge-danger text-light rounded text-lg-center ">Closed</span>
				@elseif($thread->status == 1)
					<span class="col-lg-1 badge badge-success text-light rounded text-lg-center ">Open</span>
				@endif
				<p class="col-lg-12 mb-0">Category: {{$thread->category->description}}</p>
				<p class="col-lg-12 mb-0">Owner: {{$thread->user[0]->name}}</p>
				<p class="col-lg-12 ">Posted at: {{$thread->created_at}}</p>
				<p class="col-lg-12 mb-0">Description:</p>
				<p class="col-lg-12 ">{{ $thread->description }}</p>
				<form class="row col-lg-12  rounded" method="post" action="{{url('admin/thread')}}">
					{{@csrf_field()}}
					<input type="text" name="id" value="{{ $thread->id}}" class="d-none">
					<input type="text" name="keyword" class="col-lg-11" style="margin: 0;" placeholder="Search This Forum's Thread By Content or Owner">
					<button class="col-lg-1 btn btn-primary text-light" type="submit">Search</button>
				</form>
				@if(!empty($keyword))
					Thread Search Result with '<b>{{ $keyword }}</b>' Keyword(s):
				@endif
			</div>
		</div>
		<div class="container card-body">
			@if($thread->post->isEmpty())
				<p class="col-lg-12">This forum doesnt have any thread</p>
			@else
				@foreach($posts as $p)
					<div class="card mb-3">
						<div class="card-header row">
							<a href="{{ url('admin/profile/'.$p->user[0]->id)}}" class="col-lg-10 mb-0">
								<h4>{{ $p->user[0]->name }}</h4>
							</a>
							@if($p->user[0]->id == session('user_id'))
								<form action="{{url('admin/thread-delete-post')}}" method="post" class="col-lg-1">
									{{@csrf_field()}}
									<input type="text" name="id" class="d-none" value="{{$p->id}}">
									<button class="btn btn-danger">
										delete
									</button>
								</form>
								
								<a href="{{ url('admin/thread-edit-post/'.$p->id) }}" class="col-lg-1 btn btn-warning">
									edit
								</a>
							@endif
							<p class="col-lg-12 mb-0">{{ $p->user[0]->role->description }}</p>
							<p class="col-lg-12 mb-0">Posted at: {{ $p->created_at }}</p>
						</div>
						<div class="card-body">
							<p class="col-lg-12 mb-0">{{ $p->description }}</p>
						</div>
					</div>
				@endforeach

				{{$posts->links("pagination::bootstrap-4")}}
			@endif
		</div>
	</div>
	@if($thread->status == 1)
		@if($thread->post->isEmpty())
		<div class="card">
			<div class="card-header ">
				<h4 class="mb-0">Post New Thread</h4>
			</div>
			<form class="card-body" method="post" action="{{ url('admin/thread-add-post')}}">
				<div class="container row">
					{{ @csrf_field() }}
					<p class="col-lg-12 mb-0">Content</p>
					<input type="text" name="thread_id" value="{{$thread->id}}" class="d-none">
					<textarea name="post" class="col-lg-12 rounded border-dark"></textarea>
					<div class="col-lg-12 ">
						<button type="submit" class="btn btn-primary py-2 px-4">
							Post
						</button>
					</div>
				</div>
			</form>
		</div>
		@else
		<div class="card">
			<div class="card-header ">
				<h4 class="mb-0">Edit Current Thread</h4>
			</div>
			<form class="card-body" method="post" action="{{ url('admin/thread-add-post')}}">
				<div class="container row">
					{{ @csrf_field() }}
					<p class="col-lg-12 mb-0">Content</p>
					<input type="text" name="thread_id" value="{{$thread->id}}" class="d-none">
					<textarea name="post" class="col-lg-12 rounded border-dark"></textarea>
					<div class="col-lg-12 ">
						<button type="submit" class="btn btn-primary py-2 px-4">
							Edit
						</button>
					</div>
				</div>
			</form>
		</div>
		@endif
	@endif
@stop
