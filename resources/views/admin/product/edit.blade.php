@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container w-50 mt-5">
        <form method="POST" action="{{ route('category.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $category->id }}">
            <h1 class="p-3">Category</h1>
            <div class="card">
                <h5 class="card-header">Edit Category</h5>
                <div class="card-body p-2">
                    <div class="row p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Vendor</label>
                        <div class="col-sm-12">
                            <select class="form-select" name="vendor" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($vendors as $vendor)
                                    <option
                                        value="{{ $vendor->id }}"@if (old('vendor')) @if (old('vendor') == $vendor->id) selected @endif
                                    @else @if ($category->vendor_id == $vendor->id) selected @endif @endif>
                                        {{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('vendor')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Category Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name"
                                @if (old('name')) value="{{ old('name') }}"
                            @else value="{{ $category->name }}" @endif
                                class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('name')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-3 d-flex justify-content-between">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg col-4">Sub-Category Name</label>
                        <button type="button" class="btn btn-primary col-sm-1" onclick="addSubCategory()">Add</button>
                    </div>
                    <div id="subCategory">
                        @if (old('sub_categories'))
                            @foreach (old('sub_categories') as $count => $value)
                                <div class="row m-1" id="{{ $count }}">
                                    <div class="col-10">
                                        <input type="text" name="sub_categories[{{ $count }}][name]"
                                            value="{{ $value }}" class="form-control form-control-lg"
                                            id="colFormLabelLg">
                                    </div><button type="button" class="btn btn-danger col-2"
                                        onclick="deleteSubCategory({{ $count }})">Delete</button>
                                    @error('sub_categories.' . $count)
                                        <div class="text-danger pb-1"> {{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        @else
                            @foreach ($category->subCategory as $count => $sub_category)
                                <div class="row m-1 pb-3" id="{{ $count }}">
                                    <div class="col-10">
                                        <input type="hidden" name="sub_categories[{{ $count }}][id]"
                                            value="{{ $sub_category->id }}">
                                        <input type="text" name="sub_categories[{{ $count }}][name]"
                                            value="{{ $sub_category->name }}" class="form-control form-control-lg"
                                            id="colFormLabelLg">
                                    </div><button type="button" class="btn btn-danger col-2"
                                        onclick="deleteSubCategory({{ $count }})">Delete</button>
                                    @error('sub_categories.' . $count)
                                        <div class="text-danger pb-1"> {{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('sub_categories')
                        <div class="text-danger pb-1"> {{ $message }}</div>
                    @enderror
                    <div class="pt-3">
                        <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
                        <a href="{{ route('category.index') }}" class="text-decoration-none">
                            <lable class="btn btn-danger ps-4 pr-4">Cancle</lable>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
