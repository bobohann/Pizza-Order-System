@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-10 offset-2 mt-5">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2 bg-dark">
                                    <legend class="text-center text-white"> Pizza Infomation</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane text-center" id="activity">
                                            <div class="">
                                                <img class="img-thumbnail rounded-circle"
                                                    src="{{ asset('uploads/' . $pizza->image) }}"
                                                    style="width:200px;height:200px" alt="">
                                            </div>
                                            <div class="mt-3">
                                                <b>Name</b> : <span>{{ $pizza->pizza_name }}</span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Price</b> : <span>{{ $pizza->price }}Kyats</span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Publish Status</b> :
                                                <span>
                                                    @if ($pizza->publish_status == 1)
                                                        YES
                                                    @else
                                                        NO
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Category</b> : <span>{{ $pizza->category_id }}</span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Discount Price</b> : <span>{{ $pizza->discount }}Kyats</span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Buy One Get One Status </b> :
                                                <span>
                                                    @if ($pizza->buy_one_get_one_status == 1)
                                                        YES
                                                    @else
                                                        NO
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Waiting Time </b> : <span>{{ $pizza->waiting_time }}Minutes</span>
                                            </div>
                                            <div class="mt-3">
                                                <b>Description </b> : <span>{{ $pizza->description }}</span>
                                            </div>
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
