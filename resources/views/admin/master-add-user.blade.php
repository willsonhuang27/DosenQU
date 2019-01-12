@extends('components.master')

@section('title','Master Add User Page')

@section('content')
    <div class="card">
        <div class="card-header font-weight-bold">Add New User
            <span class="text-danger"> [ {{$errors->first()}} ]</span>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('/msuser/store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Name
                    </label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group row">
					<label for="Role" class="col-md-4 col-form-label text-md-right font-weight-bold">Role</label>
					<div class="col-md-6">
						<select class="form-control" name="role">
							@foreach ($roles as $role)
							<option value="{{ $role->id }}"> {{ $role->description }}</option>
							@endforeach
						</select>
					</div>
				</div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>E-Mail Address
                    </label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Password
                    </label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Confirm Password
                    </label>

                    <div class="col-md-6">
                        <input id="confirmpassword" type="password" class="form-control" name="confirm_password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Phone
                    </label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        Address
                    </label>

                    <div class="col-md-6">
                        <textarea class="form-control" rows="2" id="address" name="address"></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Birthday
                    </label>

                    <div class="col-md-6">
                        <input id="birthday" type="text" class="form-control" name="birthday" placeholder="yyyy-mm-dd" value="{{ old('birthday') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Gender
                    </label>

                    <div class="col-md-6">
                        <div class="radio py-2">
                            <label class="mr-3"><input type="radio" name="gender" class="mr-2" value="1">Male</label>
                            <label><input type="radio" name="gender" class="mr-2" value="2">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-md-right font-weight-bold">
                        <span class="text-danger mr-1">*</span>Profile
                    </label>

                    <div class="col-md-6">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="photo" id="photo">
                            <label class="custom-file-label" for="photo">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary py-2 px-4">
                            Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#photo').on('change',function(){
            var fileName = ($(this).val()).split("\\");
            $(this).next('.custom-file-label').html(fileName[fileName.length-1]);
        })
    </script>

@stop
