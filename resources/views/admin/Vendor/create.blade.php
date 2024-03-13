@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container w-50 mt-5">
        <form method="POST" action="{{ route('vendor.store') }}">
            @csrf
            <h1 class="p-3">Vendor</h1>
            <div class="card">
                <h5 class="card-header">Create Vendor</h5>
                <div class="card-body">
                    <div class="row p-3">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg">Vendor Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control form-control-lg" id="colFormLabelLg">
                        </div>
                        @error('name')
                            <div class="text-danger pb-1"> {{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
                    <a href="{{ route('vendor.index') }}" class="text-decoration-none">
                        <lable class="btn btn-danger ps-4 pr-4">Cancle</lable>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection
