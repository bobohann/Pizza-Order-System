@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2 bg-dark">
                                    <legend class="text-center">User Profile</legend>
                                </div>
                                <div class="card-body">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('passwordErrors'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            {{ Session::get('passwordErrors') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif


                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="POST"
                                                action="{{ route('admin#updateProfile', $user->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName"
                                                            placeholder="Name" name="name"
                                                            value="{{ old('name', $user->name) }}">
                                                        @if ($errors->has('name'))
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email', $user->email) }}">
                                                        @if ($errors->has('email'))
                                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail"
                                                            placeholder="Phone" name="phone"
                                                            value="{{ old('phone', $user->phone) }}">
                                                        @if ($errors->has('phone'))
                                                            <p class="text-danger">{{ $errors->first('phone') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail"
                                                            placeholder="Address" name="address"
                                                            value="{{ old('address', $user->address) }}">
                                                        @if ($errors->has('address'))
                                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row justify-content-between">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <a href="{{ route('admin#changePasswordPage') }}">Change
                                                            Password</a>

                                                        <button type="submit"
                                                            class="btn bg-dark text-white float-end ">Update</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>
    </div>
@endsection
