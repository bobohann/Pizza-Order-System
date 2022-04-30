@extends('user.layout.style')


@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
            <a href="{{ route('user#order') }}" class="btn btn-primary float-end mt-2 col-12"><i
                    class="fas fa-shopping-cart"></i> Order</a>
            <a href="{{ route('user#index') }}">
                <button class="btn bg-dark text-white" style="margin-top: 20px;">
                    <i class="fas fa-backspace"></i> Back
                </button>
            </a>
        </div>
        <div class="col-6">
            <div class="row mb-2">
                <h5 for="">Name</h5>
                <span>{{ $pizza->pizza_name }}</span>
                <hr>

                <h5 for="">Price</h5>
                <span>{{ $pizza->price }}</span>
                <hr>

                <h5 for="">Discount Price</h5>
                <span>{{ $pizza->discount_price }} kyats</span>
                <hr>

                <h5 for="">Buy One Get One</h5>
                <span>
                    @if ($pizza->buy_one_get_one_status == 0)
                        Not have
                    @else
                        Have
                    @endif
                </span>
                <hr>

                <h5 for="">Waiting Time</h5>
                <span>{{ $pizza->waiting_time }}</span>
                <hr>

                <h5 for="">Description</h5>
                <span>{{ $pizza->description }}</span>
                <hr>

                <h3 for="" class="text-danger">Total Price</h3>
                <span class="text-success h4">{{ $pizza->price - $pizza->discount_price }} kyats</span>

            </div>

        </div>
        <div class="float-end">

        </div>

    </div>
    </div>
@endsection
