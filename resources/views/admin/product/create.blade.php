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
                        <select class="form-select" name="category" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            {{-- @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category') == $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    @error('category')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6 p-2">
                    <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Sub Category</label>
                    <div class="col-sm-12">
                        <select class="form-select" name="sub_category" aria-label="Default select example">
                            <option selected disabled>Open this select menu</option>
                            {{-- @foreach ($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}"
                                    @if (old('sub_category') == $sub_category->id) selected @endif>
                                    {{ $sub_category->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    @error('sub_category')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="row p-2 ps-3">
                    <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Name</label>
                    <div class="col-sm-12">
                        <input type="text" name="name" value="{{ old('name') }}"
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
                        <textarea class="form-control" name="description" value="{{ old('description') }}"
                        placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Description</label>
                    </div>
                    @error('description')
                    <div class="text-danger"> {{ $message }}</div>
                    @enderror
                </div>
                <div class="row p-2 ps-3">
                    <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Product Availability</label>
                    <div class="col-sm-12">
                        <input type="radio" class="btn-check" name="availability" value="1" id="success-outlined" autocomplete="off">
                        <label class="btn btn-outline-success" for="success-outlined">Available</label>

                        <input type="radio" class="btn-check" name="availability" value="0" id="danger-outlined" autocomplete="off">
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
@endsection