@extends('admin.layout.main-layout')
@section('main-container')
    <div class="main">
        <div class="d-flex justify-content-center pb-1">
            <div class="header d-flex justify-content-between w-100">
                <h4>Product</h4>
                <a href=""><button type="button" class="btn btn-outline-dark">Add Order</button></a>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Address</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">Zip</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    {{-- @foreach ($products as $index => $product) --}}
                    <tr>
                        <th scope="row">1</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href=""><button type="button" class="btn btn-outline-success">Edit</button></a>
                            <a href=""><button type="button" class="btn btn-outline-danger">Delete</button></a>
                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
        {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
    </div>
@endsection
