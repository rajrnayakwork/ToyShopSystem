@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container mt-5">
        <div class="main pt-5">
            <div class="d-flex justify-content-center pb-1">
                <div class="header d-flex justify-content-between w-100">
                    <h4>Product</h4>
                    <a href="{{ route('product.create') }}"><button type="button" class="btn btn-outline-dark">Add
                            Product</button></a>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <table class="table">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Product Sub Category</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product price</th>
                            <th scope="col">Product description</th>
                            <th scope="col">Product availability</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($products as $index => $product)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $product->subCategory->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @if ($product->availability == 1)
                                        <div class="alert alert-success d-inline-flex ps-4 pr-4 pt-1 pb-1" role="alert">
                                            Yes
                                        </div>
                                    @else
                                        <div class="alert alert-danger d-inline-flex ps-4 pr-4 pt-1 pb-1" role="alert">
                                            No
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}"><button type="button"
                                            class="btn btn-outline-success">Edit</button></a>
                                    <a href="{{ route('product.destroy', $product->id) }}"><button type="button"
                                            class="btn btn-outline-danger">Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
