@extends('layouts.app')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="content-header row">
                <div class="breadcrumbs-right breadcrumbs-top col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item">Roles</li>
                    </ol>
                </div>
            </div>
            <!-- Basic Tables start -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Roles</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a href="{{ route('roles.create') }}"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-primary"><i class="fa fa-plus"></i> Create</span></a></li>
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="role_list">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Role Name</th>
                                                <th>Description</th>
                                                <th>Created Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $roles)
                                            <tr id="role_{{ $roles->id }}">
                                                <td class="role_no">{{ $loop->iteration }}</td>
                                                <td nowrap>{{ $roles->name }}</td>
                                                <td nowrap>{{ $roles->description }}</td>
                                                <td nowrap>{{ date('m-d-Y H:i:s a', strtotime($roles->created_at)) }}</td>
                                                <td nowrap>
                                                    <a href='roles/{{ $roles->id }}/edit'><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-warning">Edit</span></a>
                                                    &nbsp;<a onclick="deleteTheRequestedResources('role', '{{ $roles->id }}', 'roles/{{ $roles->id }}', '{{ csrf_token() }}', '{{ $roles->name }}');"><i class="ft-user-plue"></i><span class="badge badge badge-pill badge-danger">Delete</span></a>
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
            <!-- Basic Tables end -->
        </div>
    </div>
</div>
@endsection