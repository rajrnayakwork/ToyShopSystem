@extends('admin.layout.main-layout')
@section('main-container')
    <dd></dd>
    <div class="container w-50">
        <form method="POST" action="{{ route('permission.storeOrUpdate', $permission->id) }}">
            @csrf
            <input type="hidden" name="id" value="{{ $permission->id }}">
            <h1 class="p-3">Product</h1>
            <div class="card">
                <h5 class="card-header">Update Permission</h5>
                <div class="card-body p-2 row">
                    <div class="col-12 p-2">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Permission Name : </label>
                        <label for="colFormLabelLg"
                            class="col-form-label col-form-label-lg ps-3">{{ $permission->display_name }}</label>
                    </div>
                    <input type="hidden" value="{{ $is_admin = false, $is_customer = false, $is_manager = false }}">
                    @foreach ($permission->role as $value)
                        @if ($value->name == 'admin')
                            <input type="hidden" value="{{ $is_admin = true, $admin_id = $value->id }}">
                        @elseif ($value->name == 'manager')
                            <input type="hidden" value="{{ $is_manager = true, $manager_id = $value->id }}">
                        @elseif ($value->name == 'customer')
                            <input type="hidden" value="{{ $is_customer = true, $customer_id = $value->id }}">
                        @endif
                    @endforeach
                    <div class="col-8 p-2 d-flex justify-content-between">
                        <label for="colFormLabelLg" class="col-form-label col-form-label-lg ps-3">Permission By Role :
                        </label>
                        <div class="form-check form-check-inline d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="admin" name="role[]"
                                @isset($admin_id)
                               value="{{ $admin_id }}"
                               @endisset
                                @if ($is_admin == true) checked @endif>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="manager" name="role[]"
                                @isset($manager_id)
                            value="{{ $manager_id }}"
                            @endisset
                                @if ($is_manager == true) checked @endif>
                            <label class="form-check-label" for="manager">Manager</label>
                        </div>
                        <div class="form-check form-check-inline d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="customer" name="role[]"
                                @isset($customer_id)
                            value="{{ $customer_id }}"
                            @endisset
                                @if ($is_customer == true) checked @endif>
                            <label class="form-check-label" for="customer">Customer</label>
                        </div>
                    </div>
                    <div class="pb-2 ps-3 pt-3">
                        <button type="submit" class="btn btn-primary ps-4 pr-4">Submit</button>
                        <a href="{{ route('permission.index') }}" class="text-decoration-none">
                            <lable class="btn btn-danger ps-4 pr-4">Cancle</lable>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
