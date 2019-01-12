@extends('components.master')

@section('title','Master User Page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>List Of User</h3>
            <a href="{{url('msuser/create')}}" class="btn btn-success">Add New User</a>
        </div>
        <div class="card-body">
            <table class="table">
      <thead class="thead-dark">
                <tr>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                      <tr>
                        <th><img class="img-thumbnail" src="{{URL::asset($user->profile_picture)}}" ></th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->role->description}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>{{$user->birth_date}}</td>
                        <td>{{$user->gender}}</td>
                        <td class="row container">
                            <div class="">
                                <a href="{{url('msuser/edit/'.$user->id)}}" class=" btn btn-warning" >Edit</a>
                            </div>
                            <form action="{{url('msuser/delete/'.$user->id)}}" class="" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="delete"/>
                                <button  class=" btn btn-danger">Delete</button>
                            </form>
                        </td>


                      </tr>
                  @endforeach


              </tbody>
            </table>
            {{$users->render("pagination::bootstrap-4")}}
        </div>
    </div>
@stop
