@extends('admin.layout.main-layout')
@section('main-container')
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    <div class="main">
        <div class="d-flex justify-content-center pb-1">
            <div class="header d-flex justify-content-between w-100">
                <h4>Category</h4>
                <a href="{{ route('category.create') }}"><button type="button" class="btn btn-outline-dark">Add
                        Category</button></a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Sub Category Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($categories as $index => $category)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $category->vendor->name }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                {{ '|' }}
                                @foreach ($sub_categories as $sub_category)
                                    @if ($category->id == $sub_category->category_id)
                                        {{ $sub_category->name . ' | ' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}"><button type="button"
                                        class="btn btn-outline-success">Edit</button></a>
                                <a href="{{ route('category.destroy', $category->id) }}"><button type="button"
                                        class="btn btn-outline-danger">Delete</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
