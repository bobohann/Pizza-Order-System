@extends('admin.layout.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid pt-2">

                <div class="row mt-4">
                    <div class="col-8 offset-2">
                        <div class="card">
                            <div class="card-header bg-dark justify-content-between">
                                <b class="fs-5 card-title">{{ $pizza[0]->categoryName }}</b>
                                <span class="fs-5 float-right">Total - {{ $pizza->total() }}</span>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th> Image</th>
                                            <th>Pizza Name</th>
                                            <th> Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($pizza as $item)
                                            <tr>
                                                <td>{{ $item->pizza_id }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/' . $item->image) }}"
                                                        class="img-thumbnail" width="150px" alt="">
                                                </td>
                                                <td>{{ $item->pizza_name }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="card-footer bg-dark">
                                <h3 class="card-title">
                                    <a href="{{ route('admin#category') }}" class="btn btn-sm btn-outline-light">Back
                                    </a>
                                </h3>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="ms-2 mt-4"> {{ $pizza->links() }}</div>

                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
