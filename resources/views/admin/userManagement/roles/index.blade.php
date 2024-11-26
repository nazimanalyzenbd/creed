@extends('layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles List</h4>
                            <a class="btn btn-info" href="{{route('roles.create')}}">Add New Role</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px;color:black">
                                    <thead>
                                        <tr>
                                            <th width="100px">Sl</th>
                                            <th>Name</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $key => $role)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-list"></i> Show</a>
                                                @can('role-edit')
                                                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-edit"></i> Edit</a>
                                                @endcan

                                                @can('role-delete')
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
