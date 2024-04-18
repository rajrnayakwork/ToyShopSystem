@extends('admin.layout.main-layout')
@section('main-container')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 id="user_name" class="fw-normal mb-0 text-black">User All Orders</h3>
                            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div id="orders_body" class="card rounded-3 mb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main">
        <div class="d-flex justify-content-center pb-1">
            <div class="header d-flex justify-content-between w-100">
                <h4>Master Order</h4>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <table class="table">
                <thead class="table">
                    <tr>
                        <th scope="col">Sr.No</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Total Orders</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users_orders as $index => $user_orders)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $user_orders['user_name'] }}</td>
                            <td>{{ $user_orders['total_orders'] }}</td>
                            <td>{{ $user_orders['total_amount'] }}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    onclick="allOrdersDetails({{ $user_orders['user_id'] }})">Show All
                                    Order Details</button>
                                {{-- <a href=""><button type="button" class="btn btn-outline-success">Edit</button></a>
                                <a href=""><button type="button" class="btn btn-outline-danger">Delete</button></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function allOrdersDetails(id) {
            axios.get("http://127.0.0.1:8000/admin/order/user-orders/" + id)
                .then(function(response) {
                    let orders = response.data;
                    document.getElementById('user_name').innerHTML = orders.name;
                    let text = ``;
                    text = `<table class="table">
                                <thead class="table">
                                    <tr>
                                        <th scope="col">Sr.No</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Order Quantity</th>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">`;
                    orders.forEach((order, index) => {
                        text += `<tr>
                                    <th scope="row">${index+1}</th>
                                    <td>${order.product.name}</td>
                                    <td>${order.product.price}</td>
                                    <td>${order.quantity}</td>
                                    <td>${order.product.description}</td>
                                    <td>${order.date_and_time}</td>
                                </tr>`;
                    });
                    text += `</tbody>
                            </table>`;
                    document.getElementById('orders_body').innerHTML = text;
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection
