@extends('components.master')

@section('title','Master Forum Page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>List of Forum</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Owner</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($threads as $t)
                        @if ($t->status == 0)
                            @php ($flag = 0)
                        @elseif($t->status == 1)
                            @php ($flag = 1)
                        @endif
                          <tr>
                            <td>{{$t->name}}</td>
                            <td>{{$t->category->description}}</td>
                            <td>{{$t->user[0]->name}}</td>
                            <td>{{$t->description}}</td>
                            @if ($flag == 0)
                                <td>Closed</td>
                            @elseif($flag == 1)
                                <td>Open</td>
                            @endif
                            <td class="container">
                                <a href="#" class=" btn btn-danger" >Close</a>
                                <a href="#" class=" btn btn-danger">Delete</a>
                            </td>


                          </tr>
                      @endforeach


                  </tbody>
            </table>
            {{$threads->render("pagination::bootstrap-4")}}
        </div>
    </div>
@stop
