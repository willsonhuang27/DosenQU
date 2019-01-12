@extends('components.master')

@section('title','Master Category Page')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3>Add New Category</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{url('mscategory/store')}}"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Name
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary py-2 px-4">
                            Add
                        </button>
                        <span class="text-danger"> [ {{$errors->first()}} ]</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3>List Of Forum Category</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @php ($i = 1)
                      @foreach ($categories as $c)

                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$c->description}}</td>
                            <td class="row">
                                <div class="col-sm-2">
                                    <a href="{{url('mscategory/edit/'.$c->id)}}" class=" btn btn-warning" >Edit</a>
                                </div>
                                <form action="{{url('mscategory/delete/'.$c->id)}}" class="col-sm-2" method="post">
                					{{csrf_field()}}
                					<input type="hidden" name="_method" value="delete"/>
                					<button  class=" btn btn-danger">Delete</button>
                				</form>

                            </td>


                          </tr>
                         @php ($i++)
                      @endforeach


                  </tbody>
            </table>

        </div>
    </div>
@stop
