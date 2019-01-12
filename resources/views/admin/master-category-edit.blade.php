@extends('components.master')

@section('title','Master Category Page')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h3>Add New Category</h3>
        </div>
        <div class="card-body">
            <form method="post" action="{{url('mscategory/update/'.$category->id)}}"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put"/>
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
                            Update
                        </button>
                        <span class="text-danger"> [ {{$errors->first()}} ]</span>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
