@extends('admin.layout.main-layout')
@section('main-container')
    <div id="view" class="container">
        <div class="main">
            <div class="d-flex justify-content-center pb-1">
                <div class="header d-flex justify-content-between w-100">
                    <h3>Permission</h3>
                    <button type="button" class="btn btn-outline-dark" onclick="updatePermissions()">Update
                        Permissions</button>
                </div>
            </div>
            <div class="">
                <table class="table">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Name</th>
                            @foreach ($roles as $value)
                                <th scope="col">{{ $value->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table">
                        @foreach ($permission_group as $group)
                            <td colspan="{{ 2 + count($roles) }}">
                                <h3>{{ $group['category'] }}</h3>
                            </td>
                            @foreach ($group['permissions'] as $index => $permission)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $permission['display_name'] }}</td>
                                    @foreach ($permission['roles'] as $role)
                                        @if ($role['has_permission'] == true)
                                            <td><i class="fa fa-check-circle" style="font-size:36px;color:green"></i></td>
                                        @else
                                            <td><i class="fa fa-times-circle" style="font-size:36px;color:red"></i></td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="update" class="container" style="display: none">
        <div class="main">
            <div class="d-flex justify-content-center pb-1">
                <div class="header d-flex justify-content-between w-100">
                    <h3>Permission</h3>
                </div>
            </div>
            <div class="">
                <table class="table">
                    <thead class="table">
                        <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Name</th>
                            @foreach ($roles as $value)
                                <th scope="col">{{ $value->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="table">
                        <form method="POST" action="{{ route('permission.storeOrUpdate') }}">
                            @csrf
                            @foreach ($permission_group as $group)
                                <td colspan="{{ 2 + count($roles) }}">
                                    <h3>{{ $group['category'] }}</h3>
                                </td>
                                @foreach ($group['permissions'] as $index => $permission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $permission['display_name'] }}</td>
                                        @foreach ($permission['roles'] as $role)
                                            <td><input class="form-check-input" type="checkbox"
                                                    @if ($role['has_permission'] == true) checked @endif
                                                    name="role_permission[{{ $role['id'] }}][]"
                                                    value="{{ $permission['id'] }}">
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-dark">Save
                    changes</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updatePermissions() {
            document.getElementById("view").style.display = 'none';
            document.getElementById("update").style.display = 'block';
        }
    </script>
@endsection
