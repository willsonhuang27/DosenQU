@extends("components.master")

@section('title','Update Forum')

@section('content')
	<div class="card">
        <div class="card-header font-weight-bold">Forum Add  [ {{$errors->first()}} ] </div>

        <div class="card-body">
            <form method="POST" action="{{url('member/thread-update')}}">
                {{@csrf_field()}}
                <input type="text" name="id" value="{{$thread->id}}" class="d-none">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label text-md-right font-weight-bold">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="name" name="name" class="form-control" value="{{$thread->name}}">
                    </div>
                </div>

				<div class="form-group row">
					<label for="category" class="col-md-4 col-form-label text-md-right font-weight-bold">Category</label>
					<div class="col-md-6">
						<select class="form-control" name="category">
							@foreach ($categories as $category)
							<option value="{{ $category->id }}"> {{ $category->description }}</option>
							@endforeach
						</select>
					</div>
				</div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right font-weight-bold">Description</label>

                    <div class="col-md-6">
						<textarea class="form-control" rows="2" id="description" name="description">{{$thread->description}}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary py-2 px-4">
                            Update Thread
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
