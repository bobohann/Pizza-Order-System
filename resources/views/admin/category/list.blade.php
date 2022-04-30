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
                            <div class="card-header bg-dark">
                                <h3 class="card-title">
                                    <a href="{{ route('admin#addCategory') }}" class="btn btn-sm btn-outline-light">Add
                                        Category</a>
                                </h3>

                                <span class="fs-5 ml-5">Total - {{ $category->total() }}</span>

                                <div class="card-tools">
                                    <form action="{{ route('admin#searchCategory') }}" method="get">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="searchData" class="form-control float-right"
                                                placeholder="Search" value="{{ old('searchData') }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">

                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Product Count</th>
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
                                            @foreach ($category as $item)
                                                <tr>
                                                    <td>{{ $item->category_id }}</td>
                                                    <td>{{ $item->category_name }}</td>
                                                    <td>
                                                        @if ($item->count == 0)
                                                            <a href="#"
                                                                class="text-decoration-none">{{ $item->count }}</a>
                                                        @else
                                                            <a href="{{ route('admin#categoryItem', $item->category_id) }}"
                                                                class="text-decoration-none">{{ $item->count }}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin#editCategory', $item->category_id) }}"
                                                            class="btn btn-sm bg-dark text-white"><i
                                                                class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin#deleteCategory', $item->category_id) }}"
                                                            class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                            <div class="card-footer bg-dark">
                                <div class="mt-2"> {{ $category->links() }}</div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
