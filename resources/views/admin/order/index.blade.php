@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container">
        <div class="d-flex flex-row-reverse">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                onclick="showCartData()">
                View Cart
            </button>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-body">
                        <div>
                            <section class="h-100">
                                <div class="container h-100 py-5">
                                    <div class="row d-flex justify-content-center align-items-center h-100">
                                        <div class="col-10">

                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                                                <h3 class="fw-normal mb-0 text-black">
                                                    Total Amount : <span id="totalAmount">1000</span>
                                                </h3>
                                            </div>

                                            <div id="cart_body" class="card rounded-3 mb-4">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="card-body">
                            <a href="{{ route('order.payment', Auth::user()->id) }}">
                                <button type="button" class="btn btn-warning btn-block btn-lg">Proceed to Pay</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="all_product">
            @foreach ($products as $product)
                <div class="col-lg-3 pt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Product : {{ $product->name }}</h5>
                            <p class="card-text">Price : {{ $product->price }}</p>
                            <p class="card-text">Description : {{ $product->description }}</p>
                            <p class="card-text">Availability : {{ $product->availability == 1 ? 'Yes' : 'No' }}</p>
                            <p class="card-text">Sub Category : {{ $product->subCategory->name }}</p>
                            <div class="d-flex">
                                <div class="d-flex pt-2 w-50">
                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <input id="quantity{{ $product->id }}" min="1" name="quantity" value="1"
                                        type="number" class="form-control form-control-sm" />

                                    <button class="btn btn-link px-2"
                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">Add To
                                    Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        // window.onload = function() {
        //     showCartData();
        // }

        function addToCart(product_id) {
            let user_id = {{ Auth::user()->id }};
            let quantity = document.getElementById('quantity' + product_id).value;
            let data = {
                quantity: quantity,
                user_id: user_id,
                product_id: product_id,
            }
            axios.post("http://127.0.0.1:8000/admin/cart/store-or-update/", data)
                .then(function(response) {
                    showCartData();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function editCart(id) {
            let quantity = document.getElementById('cartQuantity' + id).value;
            if (quantity <= 0) {
                destroyCart(id);
                return;
            }
            let user_id = {{ Auth::user()->id }};
            let product_id = document.getElementById('cartProduct' + id).value;
            let data = {
                quantity: quantity,
                user_id: user_id,
                product_id: product_id,
            }
            axios.post("http://127.0.0.1:8000/admin/cart/store-or-update/" + id, data)
                .then(function(response) {
                    showCartData('true');
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function destroyCart(id) {
            axios.get(`http://127.0.0.1:8000/admin/cart/destroy/${id}`)
                .then(function(response) {
                    showCartData();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function showCartData(action = 'false') {
            axios.get("http://127.0.0.1:8000/admin/cart/")
                .then(function(response) {
                    let carts = response.data;
                    if (action == 'true') {
                        let total = 0;
                        carts.forEach(cart => {
                            total += cart.product.price * cart.quantity;
                        });
                        document.getElementById('totalAmount').innerHTML = total;
                    } else {
                        document.getElementById('cart_body').innerHTML = '';
                        let total = 0;
                        carts.forEach(cart => {
                            total += cart.product.price * cart.quantity;
                            let li = `
                            <div class="card-body p-4">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2"><span class="text-muted">Product:
                                            </span>${cart.product.name}</p>
                                    </div>
                                    <input type="hidden" id="cartProduct${ cart.id }" value="${cart.product_id}">
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown();editCart(${ cart.id })">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="cartQuantity${ cart.id }" min="0" name="quantity"
                                            value="${cart.quantity}" type="number" onchange="editCart(${ cart.id })"
                                            class="form-control form-control-sm" />

                                        <button class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp();editCart(${ cart.id })">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <p class="lead fw-normal mb-2"><span class="text-muted">Price:
                                            </span>${cart.product.price}</p>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a onclick="destroyCart(${cart.id})" class="text-danger"><i
                                                class="fas fa-trash fa-lg"></i></a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            `;
                            document.getElementById('cart_body').innerHTML += li;
                            document.getElementById('totalAmount').innerHTML = total;
                        });
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>
@endsection

{{-- <li class="list-group-item d-flex justify-content-between align-items-start">
    <div class="ms-2 me-auto">
        <div class="fw-bold">neno</div>
        150
    </div>
    <div class="d-flex align-items-center">
        <span class="badge text-bg-primary rounded-pill mr-3">14</span>
        <span class="badge text-bg-danger rounded-pill"><button class="btn btn-danger">Delete</button></span>
    </div>
</li> --}}

{{-- <form method="POST" action="">
    @csrf
    <input type="hidden" name="id" value="">
    <h1 class="p-3">Order</h1>
    <div class="card">
        <h5 class="card-header">Search Product</h5>
        <div class="card-body p-2 row">
            <div class="col-3 p-2">
                <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Vendor</label>
                <div class="col-sm-12">
                    <select class="form-select" id="sub_category" name="sub_category"
                        aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                        @foreach ($vendors as $vendor)
                        <option value="{{ 1 }}">one </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3 p-2">
                <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Category</label>
                <div class="col-sm-12">
                    <select class="form-select" id="category" name="category" aria-label="Default select example"
                        onchange="showSubCategory()">
                        <option selected disabled>Open this select menu</option>
                        <option value="1">one </option>
                    </select>
                </div>
            </div>
            <div class="col-3 p-2">
                <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Sub Category</label>
                <div class="col-sm-12">
                    <select class="form-select" id="sub_category" name="sub_category"
                        aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                    </select>
                </div>
            </div>
            <div class="col-3 p-2">
                <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Product</label>
                <div class="col-sm-12">
                    <select class="form-select" id="sub_category" name="sub_category"
                        aria-label="Default select example">
                        <option selected disabled>Open this select menu</option>
                    </select>
                </div>
            </div>
            <div class="p-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
            </div>

        </div>
    </div>
</form> --}}
