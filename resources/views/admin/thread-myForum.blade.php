@extends('components.master')

@section('title','My Forum Page')

@section('content')
    
    @foreach($threads as $thread)
    <div class="card mb-3">
        <div class="card-header relative">
            <div class="row absolute absolute-right-top">
                @if($thread->status == 1)
                <form method="get" action="{{url('admin/thread-update/'.$thread->id)}}">
                    <button class="btn btn-warning" type="submit" name="edit">Edit</button>
                </form>
                <form method="post" action="{{url('admin/thread-close')}}">
                    {{@csrf_field()}}
                    <input type="text" name="id" value="{{$thread->id}}" class="d-none">
                    <button class="btn btn-danger" type="submit" name="close">Close</button>
                    
                </form>
                @endif
            </div>
            <h4 class="col-lg-12 mb-0">{{$thread->name}}</h4>
            @if($thread->status == 1)
            <p class="col-lg-12 mb-0">Status: <span class="p-status bg-success text-light rounded text-lg-center">Open</span></p>
            @elseif($thread->status == 0)
            <p class="col-lg-12 mb-0">Status: <span class="p-status bg-danger text-light rounded text-lg-center">Closed</span></p>
            @endif
        </div>
        <div class="card-body">
            <p class="col-lg-12 mb-0">{{$thread->description}}</p>
        </div>
    </div>
    @endforeach
    {{$threads->links("pagination::bootstrap-4")}}
@stop
