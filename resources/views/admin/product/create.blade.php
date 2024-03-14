@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container w-50">
        <form method="POST" action="{{ route('product.store') }}">
            @csrf
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
                    <div class="row p-2 ps-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Price</label>
                        <div class="col-sm-12">
                            <input type="text" name="price" value="{{ old('price') }}"
                                class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('price')
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
                    <div class="row p-2 ps-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Availability</label>
                        <div class="col-sm-12">
                            <input type="radio" class="btn-check" name="availability" value="1" id="success-outlined"
                                autocomplete="off">
                            <label class="btn btn-outline-success" for="success-outlined">Available</label>

                            <input type="radio" class="btn-check" name="availability" value="0" id="danger-outlined"
                                autocomplete="off">
                            <label class="btn btn-outline-danger" for="danger-outlined">Not Available</label>
                        </div>
                        @error('availability')
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
    </script>
@endsection
