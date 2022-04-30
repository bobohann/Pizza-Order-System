@extends('user.layout.style')


@section('content')
    <div class="row mt-5 d-flex justify-content-center">

        <div class="col-4 ">
            <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
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
                <span>{{ $pizza->price - $pizza->discount_price }} kyats</span>
                <hr>

                <h5 for="">Waiting Time</h5>
                <span>{{ $pizza->waiting_time }}</span>
                <hr>

                <form action="" method="POST" class="">
                    @csrf
                    <div class="card col-6 offset-4 mt-4">
                        <div class="card-header bg-dark text-white h3 text-center">Report Order</div>
                        <div class="card-body">
                            @if (Session::has('totalTime'))
                                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                                    Order Success! Please wait <span
                                        class="text-danger">{{ Session::get('totalTime') }}</span> Minutes...
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h5 for="">Pizza Count</h5>

                            <input type="number" maxlength="3" name="pizzaCount" placeholder="Number of pizza you want"
                                id="" class="form-control">
                            @if ($errors->has('pizzaCount'))
                                <p class="text-danger">{{ $errors->first('pizzaCount') }}</p>
                            @endif
                            <br>
                            <h5 for="">Payment Type</h5>
                            <div class="d-flex">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1"
                                        value="1">
                                    <label class="form-check-label" for="inlineRadio1">Credit Card</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2"
                                        value="2">
                                    <label class="form-check-label" for="inlineRadio2">Cash</label>
                                </div>
                            </div>
                            <div>
                                @if ($errors->has('paymentType'))
                                    <p class="text-danger">{{ $errors->first('paymentType') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer bg-dark col">
                            <button type="submit" class="btn btn-outline-light "><i class="fas fa-shopping-cart"></i>
                                Order</button>

                        </div>
                    </div>

                </form>

            </div>

        </div>
        <div class="float-end">

        </div>

    </div>
    </div>
@endsection
