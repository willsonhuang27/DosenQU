@extends("components.master")

@section('title','Update Forum')

@section('content')
	<div class="card">
        <div class="card-header font-weight-bold">Edit Thread Content <span class="text-danger"> [ {{$errors->first()}} ]</span></div>

        <div class="card-body">
            <form method="post" action="{{url('admin/thread-edit-post')}}">
                {{ @csrf_field() }}
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right font-weight-bold">Description</label>
                
                    <div class="col-md-6">
						<textarea class="form-control" rows="2" id="description" name="description">{{$post->description}}</textarea>
                    </div>
                </div>
                <input type="text" name="id" value="{{$post->id}}" class="d-none">
                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary py-2 px-4">
                            Update Post
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
