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
                                    <legend class="text-center">Update Password</legend>
                                </div>
                                <div class="card-body">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                            {{ Session::get('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (Session::has('notMatchError'))
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            {{ Session::get('notMatchError') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="POST"
                                                action="{{ route('admin#changePassword', Auth()->user()->id) }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Old
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="inputName"
                                                            placeholder="" name="oldPassword"
                                                            value="{{ old('oldPassword') }}">
                                                        @if ($errors->has('oldPassword'))
                                                            <p class="text-danger">{{ $errors->first('oldPassword') }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">New
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="inputEmail"
                                                            placeholder="" name="newPassword"
                                                            value="{{ old('newPassword') }}">
                                                        @if ($errors->has('newPassword'))
                                                            <p class="text-danger">{{ $errors->first('newPassword') }}
                                                            </p>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Confirm
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" id="inputEmail"
                                                            placeholder="" name="confirmPassword"
                                                            value="{{ old('confirmPassword') }}">
                                                        @if ($errors->has('confirmPassword'))
                                                            <p class="text-danger">
                                                                {{ $errors->first('confirmPassword') }}</p>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="form-group row justify-content-between">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit"
                                                            class="btn bg-dark text-white float-end ">Update
                                                            Password</button>
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
