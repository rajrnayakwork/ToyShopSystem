@extends('admin.layout.main-layout')
@section('main-container')
    <div class="container mt-5">
        <div class="main pt-5">
            <div class="d-flex justify-content-center pb-1">
                <div class="header d-flex justify-content-between w-100">
                    <h4>Permission</h4>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <table class="table">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Display Name</th>
                            <th scope="col">Admin</th>
                            <th scope="col">Manager</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($permissions as $index => $permission)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <input type="hidden"
                                    value="{{ $is_admin = false, $is_customer = false, $is_manager = false }}">
                                @foreach ($permission->role as $value)
                                    @if ($value->name == 'admin')
                                        <input type="hidden" value="{{ $is_admin = true }}">
                                    @elseif ($value->name == 'manager')
                                        <input type="hidden" value="{{ $is_manager = true }}">
                                    @elseif ($value->name == 'customer')
                                        <input type="hidden" value="{{ $is_customer = true }}">
                                    @endif
                                @endforeach
                                @if ($is_admin == true)
                                    <td><i class="fa fa-check-circle" style="font-size:36px;color:green"></i></td>
                                @else
                                    <td><i class="fa fa-times-circle" style="font-size:36px;color:red"></i></td>
                                @endif
                                @if ($is_manager == true)
                                    <td><i class="fa fa-check-circle" style="font-size:36px;color:green"></i></td>
                                @else
                                    <td><i class="fa fa-times-circle" style="font-size:36px;color:red"></i></td>
                                @endif
                                @if ($is_customer == true)
                                    <td><i class="fa fa-check-circle" style="font-size:36px;color:green"></i></td>
                                @else
                                    <td><i class="fa fa-times-circle" style="font-size:36px;color:red"></i></td>
                                @endif
                                <td>
                                    <a href="{{ route('permission.edit', $permission->id) }}"><button type="button"
                                            class="btn btn-outline-success">Edit</button></a>
                                    <a href=""><button type="button"
                                            class="btn btn-outline-danger">Delete</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
