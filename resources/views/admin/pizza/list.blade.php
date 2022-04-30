@extends('admin.layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid pt-2">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class=" p-4 card-header bg-dark">

                                <h3 class="card-title ms-4">
                                    <a href="{{ route('admin#createPizza') }}" class="btn btn-sm btn-outline-light">Add
                                        Pizza</a>
                                </h3>

                                <span class="fs-5 ml-5">Total - {{ $pizza->total() }}</span>

                                <div class="card-tools ms-5">
                                    <form action="{{ route('admin#searchPizza') }}" method="get">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">

                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pizza Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Publish Status</th>
                                        <th>Buy 1 Get 1 Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($status == 0)
                                        <tr>
                                            <td colspan="7">
                                                <p class="text-muted">There is no data</p>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($pizza as $item)
                                            <tr>
                                                <td>{{ $item->pizza_id }}</td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/' . $item->image) }}"
                                                        class="img-thumbnail" width="100px">
                                                </td>
                                                <td>{{ $item->price }} kyats</td>
                                                <td>
                                                    @if ($item->publish_status == 1)
                                                        Publish
                                                    @elseif ($item->publish_status == 0)
                                                        Unplish
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->buy_one_get_one_status == 1)
                                                        Yes
                                                    @elseif ($item->buy_one_get_one_status == 0)
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin#editPizza', $item->pizza_id) }}"
                                                        class="btn btn-sm bg-dark text-white"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin#deletePizza', $item->pizza_id) }}"
                                                        class="btn btn-sm bg-danger text-white"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                    <a href="{{ route('admin#pizzaInfo', $item->pizza_id) }}"
                                                        class="btn btn-sm bg-primary text-white"><i
                                                            class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-dark">
                            <div class="mt-2"> {{ $pizza->links() }}</div>

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
