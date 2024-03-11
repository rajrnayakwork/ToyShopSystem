@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container w-50 mt-5">
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            <h1 class="p-3">Category</h1>
            <div class="card">
                <h5 class="card-header">Create Category</h5>
                <div class="card-body p-2">
                    <div class="row p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Branch</label>
                        <div class="col-sm-12">
                            <select class="form-select" name="branch" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" @if (old('branch') == $branch->id) selected @endif>
                                        {{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('branch')
                            <div class="text-danger"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Category Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('name')
                            <div class="text-danger pb-1"> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg col-4">Sub-Category Name</label>
                        <button type="button" class="btn btn-primary col-sm-1" onclick="addSubCategory()">Add</button>
                    </div>
                    <div id="subCategory">
                    </div>
                    @error('subCategoryName')
                        <div class="text-danger pb-1"> {{ $message }}</div>
                    @enderror
                    <div class="pt-3">
                        <a href="{{ route('category.index') }}" class="text-decoration-none">
                            <lable class="btn btn-danger ps-4 pr-4">Cancle</lable>
                        </a>
                        <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
@endsection
{{-- <div class="row">
                            <div class="col-10">
                                <input type="text" name="sub_category" class="form-control form-control-lg"
                                    id="colFormLabelLg">
                            </div>
                            <button class="btn btn-danger col-2">Delete</button>
                        </div> --}}
