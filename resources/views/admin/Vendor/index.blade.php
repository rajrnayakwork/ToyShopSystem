@extends('admin.layout.main-layout')
@section('main-container')
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="main">
        <div class="d-flex justify-content-center pb-1">
            <div class="header d-flex justify-content-between w-100">
                <h4>Vendor</h4>
                <a href="{{ route('vendor.create') }}"><button type="button" class="btn btn-outline-dark">Add
                        Vendor</button></a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($vendors as $index => $vendor)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $vendor->name }}</td>
                            <td>
                                <a href="{{ route('vendor.edit', [$vendor->id]) }}"><button type="button"
                                        class="btn btn-outline-success">Edit</button></a>
                                <a href="{{ route('vendor.destroy', $vendor->id) }}"><button type="button"
                                        class="btn btn-outline-danger">Delete</button></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $vendors->links('pagination::bootstrap-5') }}
    </div>
@endsection
