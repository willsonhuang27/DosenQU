@extends('components.master')

@section('title','Inbox')

@section('content')
    @foreach($messages as $message)
        <div class="card mb-3">
                <div class="card-header relative">
                    <form action="{{url('admin/delete-message')}}" method="post">
                        {{ @csrf_field() }}
                        <input type="text" name="message_id" class="d-none" value="{{$message->id}}">
                        <button type="submit" name="button" class="btn btn-danger absolute absolute-right-top "><i class="fa fa-search"></i>Delete</button>
                    </form>


                <a href="{{ url('admin/profile/'.$message->user[0]->id)}}">
                    <h3 class="text-primary">{{$message->user[0]->name}}</h3>
                </a>

                    
                    <p>{{$message->created_at}}</p>
                </div>
                <div class="card-body">
                    {{$message->message}}
                </div>
        </div>
    @endforeach
    {{$messages->render("pagination::bootstrap-4")}}
@stop
