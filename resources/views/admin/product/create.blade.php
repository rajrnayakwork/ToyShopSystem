@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container w-50">
        <form method="POST" action="{{ route('product.storeOrUpdate') }}">
            @csrf
            <input type="hidden" name="id" value="">
            <h1 class="p-3">Product</h1>
            <div class="card">
                <h5 class="card-header">Create Product</h5>
                <div class="card-body p-2 row">
                    <div class="col-6 p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Category</label>
                        <div class="col-sm-12">
                            <select class="form-select" id="category" name="category" aria-label="Default select example"
                                onchange="showSubCategory()">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Sub Category</label>
                        <div class="col-sm-12">
                            <select class="form-select" id="sub_category" name="sub_category"
                                aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                            </select>
                        </div>
                        @error('sub_category')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2 ps-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('name')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row ps-3 d-flex justify-content-between">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg col-5">Add Product
                            Quantity</label>
                        <button type="button" id="changebtn" class="btn btn-primary col-sm-2 mr-2"
                            onclick="showQuantityInput()">Click</button>
                    </div>
                    <div id="price_id" class="row p-2 ps-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Price</label>
                        <div class="col-sm-12">
                            <input type="text" name="price" value="{{ old('price') }}"
                                class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('price')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2 ps-3 col-6" id="quantity">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product
                            Quantity</label>
                        <div class="col-sm-12">
                            <input type="text" name="quantity" value="0" class="form-control form-control-lg"
                                id="colFormLabelLg">
                        </div>
                        @error('quantity')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2 ps-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="Leave a comment here"
                                id="floatingTextarea"></textarea>
                        </div>
                        @error('description')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="pb-2 ps-3">
                        <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
                        <a href="{{ route('product.index') }}" class="text-decoration-none">
                            <lable class="btn btn-danger ps-4 pr-4">Cancle</lable>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function showSubCategory() {
            let value = document.getElementById("category").value;
            axios
                .get("http://127.0.0.1:8000/admin/product/category/" + value)
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

        window.onload = function() {
            showQuantityInput();
        }

        function showQuantityInput() {
            let quantity_div = document.getElementById('quantity');
            let price_div = document.getElementById('price_id');
            if (quantity_div.style.display === "none") {
                quantity_div.style.display = "block";
                price_div.setAttribute("class", 'row p - 2 ps - 3 col-6');

            } else {
                quantity_div.style.display = "none";
                price_div.setAttribute("class", 'row p - 2 ps - 3');
            }
        }
    </script>
@endsection
