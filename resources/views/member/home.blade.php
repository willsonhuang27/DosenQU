@extends('components.master')

@section('title','home')

@section('content')
	<div class="container search-box  ">
		<form class="row  rounded mb-5" method="post" action="{{url('member')}}">
			{{@csrf_field()}}
			<input type="text" name="id" class="d-none">
			<input type="text" name="keyword" class="col-lg-11" style="margin: 0;" placeholder="Search This Forum's Thread By Content or Owner">
			<button class="col-lg-1 btn btn-primary text-light" type="submit">Search</button>
		</form>
		@if(!empty($keyword))
			Thread Search Result with '<b>{{ $keyword }}</b>' Keyword(s):
		@endif

		{{-- per items --}}

		@if($threads->isEmpty())
			<p class="col-lg-12">This forum doesnt have any thread</p>
		@else
			@foreach($threads as $thread)
			<div class="row jumbotron" style="padding: 0; padding: 10px;">
					<a href="{{ url('member/thread/'.$thread->id)}}" style="text-decoration: none;" class="col-lg-11">
							<h4 >{{ $thread->name}} </h4>
						</a>
					@if ($thread->status == 0)
						<span class="col-lg-1 bg-danger text-light rounded text-lg-center ">Closed</span>
					@elseif ($thread->status == 1)
						<span class="col-lg-1 bg-success text-light rounded text-lg-center ">Open</span>
					@endif
					<p class="col-lg-12">Category : {{ $thread->category->description }}</p>
					<p class="col-lg-12">Posted at : {{ date('d M Y H:i:s', strtotime($thread->created_at)) }}</p>
					<div class="col-lg-12 bg-light rounded" style="padding: 10px;">
						{{ $thread->description }}
					</div>
			</div>
			@endforeach
			{{$threads->links("pagination::bootstrap-4")}}
		@endif

		<btn class="btn btn-add-forum bg-secondary text-light"
		onclick="window.location='{{ url("member/thread-create") }}'">
				+
		</btn>
	</div>
@stop
