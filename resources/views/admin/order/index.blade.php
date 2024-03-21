@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container">
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
                                                    Total Amount : <span id="totalAmount">0</span>
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

        <div class="card">
            <h5 class="card-header">Filter Product</h5>
            <div class="card-body p-2 row">
                <div class="col-5 p-2">
                    <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Category</label>
                    <div class="col-sm-12">
                        <select class="form-select" id="category" name="category" aria-label="Default select example"
                            onchange="showSubCategory()">
                            <option selected disabled>Open this select menu</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-5 p-2">
                    <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Sub Category</label>
                    <div class="col-sm-12">
                        <select class="form-select" id="sub_category" name="sub_category"
                            aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                        </select>
                    </div>
                </div>
                <div class="col-2 d-flex justify-content-center" style="display:inline; height:95px">
                    <button type="button" class="btn btn-primary mt-5" onclick="ShowOrders()">Submit</button>
                </div>
            </div>
        </div>

        <div class="row mb-5" id="all_product">
        </div>
    </div>
    <script>
        window.onload = function() {
            document.getElementById('cart_button').style.display = 'inline';
        }

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
                                            onclick="ChangeQuantity(2,'cartQuantity',${cart.id},${cart.product.quantity})">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="cartQuantity${ cart.id }" min="0" max="${cart.product.quantity}" name="quantity"
                                            value="${cart.quantity}" type="number" onchange="editCart(${ cart.id })"
                                            class="form-control form-control-sm" />

                                        <button class="btn btn-link px-2"
                                            onclick="ChangeQuantity(1,'cartQuantity',${cart.id},${cart.product.quantity})">
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
                        });
                        document.getElementById('totalAmount').innerHTML = total;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function showSubCategory() {
            let value = document.getElementById("category").value;
            axios
                .get("http://127.0.0.1:8000/admin/order/category/" + value)
                .then(function(response) {
                    document.getElementById("sub_category").innerHTML = "";
                    response["data"].forEach((result) => {
                        const option = document.createElement("option");
                        option.setAttribute("value", result.id);
                        option.innerHTML = result.name;
                        document.getElementById("sub_category").appendChild(option);
                    });
                })
                .catch(function(error) {
                    document.getElementById("sub_category").innerHTML = "";
                    console.log(error);
                });
        }

        function ShowOrders() {
            let sub_category = document.getElementById("sub_category").value;
            axios
                .get("http://127.0.0.1:8000/admin/order/sub_category/" + sub_category)
                .then(function(response) {
                    document.getElementById('all_product').innerHTML = '';
                    response.data.forEach(product => {
                        if (product.availability == 0) {
                            return;
                        }
                        let text = `<div class="col-lg-3 pt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Product : ${product.name}</h5>
                                                <p class="card-text">Price : ${product.price}</p>
                                                <p class="card-text">Description : ${product.description}</p>
                                                <p class="card-text">Availability : ${(product.availability == 1) ? 'Yes' : 'No'} </p>
                                                <p class="card-text">Sub Category : ${product.sub_category.name}</p>
                                                <p class="card-text">Quantity : ${product.quantity}</p>
                                                <div class="d-flex">
                                                    <div class="d-flex pt-2 w-50">
                                                        <button class="btn btn-link px-2"
                                                            onclick="ChangeQuantity(2,'quantity',${product.id},${product.quantity})">
                                                            <i class="fas fa-minus"></i>
                                                        </button>

                                                        <input
                                                            id="quantity${product.id}" min="1" max="${product.quantity}" name="quantity" value="1"
                                                            type="number" class="form-control form-control-sm" onchange="ChangeQuantity(3,'quantity',${product.id},${product.quantity})" />

                                                        <button class="btn btn-link px-2"
                                                            onclick="ChangeQuantity(1,'quantity',${product.id},${product.quantity})">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <button class="btn btn-primary"
                                                        onclick="addToCart(${product.id})">
                                                        Add To Cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        document.getElementById('all_product').innerHTML += text;
                    });
                })
                .catch(function(error) {
                    document.getElementById("sub_category").innerHTML = "";
                    console.log(error);
                });
        }

        function ChangeQuantity(value, name, id, quantity) {
            let input = document.getElementById(name + id);
            number = Number(input.value);

            if (name == 'cartQuantity' && value == 2 && number == 1) {
                destroyCart(id);
            }
            if (value == 1 && number < quantity) {
                if (name == 'cartQuantity') {
                    input.value = number + 1;
                    editCart(id);
                } else {
                    input.value = number + 1;
                }
            } else if (value == 2 && number > 1) {
                if (name == 'cartQuantity') {
                    input.value = number - 1;
                    editCart(id);
                } else {
                    input.value = number - 1;
                }
            } else if (value == 3 && number > quantity) {
                input.value = quantity;
            }
        }
    </script>
@endsection
