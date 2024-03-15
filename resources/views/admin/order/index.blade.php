@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container">
        <ol id="cart_list" class="list-group list-group-numbered col-6">
        </ol>
        <div class="row" id="all_product">

            @foreach ($products as $product)
                <div class="col-lg-3 pt-4">
                    <div class="card">
                        <div class="card-body">
                            {{-- <input type="hidden" id="cart_id{{ $product->id }}" value=""> --}}
                            <h5 class="card-title">Product : {{ $product->name }}</h5>
                            <p class="card-text">Price : {{ $product->price }}</p>
                            <p class="card-text">Description : {{ $product->description }}</p>
                            <p class="card-text">Availability : {{ $product->availability == 1 ? 'Yes' : 'No' }}</p>
                            <p class="card-text">Sub Category : {{ $product->subCategory->name }}</p>
                            <button class="btn btn-primary" onclick="addToCart({{ $product->id }})">Add To Cart</button>
                            <div class="d-flex pt-2">
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        window.onload = function() {
            showCartData();
        }

        function addToCart(product_id) {
            let user_id = {{ Auth::user()->id }};
            let quantity = document.getElementById('quantity' + product_id).value;
            let data = {
                quantity: quantity,
                user_id: user_id,
                product_id: product_id,
            }
            axios.post("http://127.0.0.1:8000/admin/cart/", data)
                .then(function(response) {
                    console.log(response.data);
                    showCartData();
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        function showCartData() {
            document.getElementById('cart_list').innerHTML = '';
            axios.get("http://127.0.0.1:8000/admin/cart/")
                .then(function(response) {
                    let carts = response.data;
                    carts.forEach(cart => {
                        let li = `<li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">name : ${cart.product.name}</div>
                            price : ${cart.product.price}
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge text-bg-primary rounded-pill mr-3 p-2">${cart.quantity}</span>
                            <span class="badge text-bg-danger rounded-pill"><button class="btn btn-danger">Delete</button></span>
                        </div>
                    </li>`;
                        document.getElementById('cart_list').innerHTML += li;
                    });
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        // function showSubCategory() {
        //     let value = document.getElementById("category").value;
        //     axios
        //         .get("http://127.0.0.1:8000/admin/product/category/" + value)
        //         .then(function(response) {
        //             document.getElementById("sub_category").innerHTML = "";
        //             response["data"].forEach((result) => {
        //                 const option = document.createElement("option");
        //                 option.setAttribute("value", result.id);
        //                 option.innerHTML = result.name;
        //                 document.getElementById("sub_category").appendChild(option);
        //             });
        //         })
        //         .catch(function(error) {
        //             document.getElementById("sub_category").innerHTML = "";
        //             console.log(error);
        //         });
        // }
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


{{-- <div id="product" class="col-lg-3 pt-4">
    <div class="card">
        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/181.webp" class="card-img-top"
            alt="Waterfall" />
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">
                Some quick example text to build on the card title and make up the bulk
                of the card's content.
            </p>
            <a href="#!" class="btn btn-primary">Button</a>
        </div>
    </div>
</div> --}}


{{-- <script>
    window.onload = function() {
        let p = document.getElementById('all_product');
        p.innerHTML = ``;
    }
</script> --}}
