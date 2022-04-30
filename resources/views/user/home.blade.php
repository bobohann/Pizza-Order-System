@extends('user.layout.style')

@section('content')
    <!-- Page Content-->
    <div class="container px-2 px-lg-5" id="home">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" id="code-lab-pizza"
                    src="https://www.pizzamarumyanmar.com/wp-content/uploads/2019/04/chigago.jpg" alt="..." /></div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">CODE LAB Pizza</h1>
                <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it,
                    but it makes a great use of the standard Bootstrap core components. Feel free to use this template
                    for any project you want!</p>
                <a class="btn btn-primary" href="#!">Enjoy!</a>
            </div>
        </div>

        <!-- Content Row-->
        <div class="container d-flex">
            <div class="col-3 me-5">
                <div class="">
                    <div class="py-1 text-center">
                        <form class="d-flex m-5" method="GET" action="{{ route('user#searchItem') }}">
                            @csrf
                            <input class="form-control me-2" name="searchData" type="search" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </form>

                        <div class="">
                            <h3 class="mb-3">Category</h3>
                            <a href="{{ route('user#index') }}" class="text-decoration-none text-black">
                                <div class="m-2 p-2">All</div>
                            </a>
                            @foreach ($category as $item)
                                <a href="{{ route('user#categorySearch', $item->category_id) }}"
                                    class="text-decoration-none text-black">
                                    <div class="m-2 p-2">{{ $item->category_name }}</div>
                                </a>
                            @endforeach
                        </div>
                        <hr>
                        <form action="{{ route('user#searchPizzaItem') }}" method="get">
                            @csrf
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Start Date - End Date</h3>
                                <input type="date" name="startDate" id="" class="form-control"> -
                                <input type="date" name="endDate" id="" class="form-control">

                            </div>
                            <hr>
                            <div class="text-center m-4 p-2">
                                <h3 class="mb-3">Min - Max Amount</h3>

                                <input type="number" name="minPrice" id="" class="form-control"
                                    placeholder="minimum price"> -
                                <input type="number" name="maxPrice" id="" class="form-control"
                                    placeholder="maximun price">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-dark text-white">Search<i
                                        class="fas fa-search ms-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                @if ($status == 1)
                    <div class="row" id="pizza">
                        @foreach ($pizza as $item)
                            <div class="col-4 mb-5">
                                <div class="card h-100" style="width: 200px;">
                                    <!-- Sale badge-->
                                    @if ($item->buy_one_get_one_status == 1)
                                        <div class="badge bg-danger text-white position-absolute"
                                            style="top: 0.5rem; right: 0.5rem">
                                            Buy 1 Get 1</div>
                                    @endif

                                    <!-- Product image-->
                                    <img class="card-img-top" id="pizza-image" width="200px"
                                        src="{{ asset('uploads/' . $item->image) }}" alt="..." />
                                    <!-- Product details-->
                                    <div class="card-body p-4">
                                        <div class="text-center">
                                            <!-- Product name-->
                                            <h5 class="fw-bolder">{{ $item->pizza_name }}</h5>
                                            <!-- Product price-->
                                            <span class="">{{ $item->price }}kyats</span>
                                            {{-- {{ $item->discount }} --}}
                                        </div>
                                    </div>
                                    <!-- Product actions-->
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center"><a
                                                href="{{ route('user#pizzaDetail', $item->pizza_id) }}"
                                                class="btn btn-outline-dark mt-auto" href="#">More
                                                Detail</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger position-absolute" role="alert" style="width: 50%; margin-top:0%;">
                        There is no pizza...
                    </div>
                @endif
                {{ $pizza->links() }}
            </div>
        </div>
    </div>

    <div class="text-center d-flex justify-content-center align-items-center" id="contact">
        <div class="col-4 border shadow-sm ps-5 pt-5 pe-5 pb-2 mb-5">
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3>Contact Us</h3>

            <form action="{{ route('user#createContact') }}" class="my-4" method="POST">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}" class="form-control my-3" placeholder="Name">
                @if ($errors->has('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
                <input type="text" name="email" value="{{ old('email') }}" class="form-control my-3" placeholder="Email">
                @if ($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
                <textarea class="form-control my-3" name="message" rows="3" placeholder="Message">{{ old('message') }}</textarea>
                @if ($errors->has('message'))
                    <p class="text-danger">{{ $errors->first('message') }}</p>
                @endif
                <button type="submit" class="btn btn-dark">Send <i class="fas fa-arrow-right"></i></button>
            </form>
        </div>
    </div>
@endsection
